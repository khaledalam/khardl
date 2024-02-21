<?php

namespace Tests\Feature\Web\Central\Promoter;

use App\Http\Controllers\Web\Central\GlobalPromoterController;
use App\Models\Promoter;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;



class PromoterPageTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }
    public function createPromoter($options = null): Promoter
    {
        return Promoter::factory()->create($options);
    }
    public function test_page_exist_and_has_promoter()
    {
        $promoter = $this->createPromoter();
        $response = $this->getJson('/promoter/' . $promoter->name);
        $response->assertSee(__('Name'));
        $response->assertSee(__('URL'));
        $response->assertSee(__('Registered Users Count'));
        $response->assertSee(__('The number of users who used the link'));
        $response->assertSee($promoter->name);
        $response->assertSee($promoter->url);
        $response->assertSee($promoter->entered);
        $response->assertSee($promoter->registered);
    }
    public function test_has_no_promoter()
    {
        $response = $this->getJson('/promoter/' . fake()->name);
        $response->assertSee(__('Not found promoter'));
        $this->assertDatabaseHas('promoters_failed_attempts', [
            'ip_address' => request()->ip(),
            'attempts' => 1
        ]);
    }
    public function test_many_failed_attempts()
    {
        $controller = new GlobalPromoterController();
        $this->insertPromoterFailedAttempt($controller::AttemptsCount);
        $response = $this->getJson('/promoter/' . fake()->name);
        $response->assertRedirectToRoute('home');
        $response->assertDontSee(__('Not found promoter'));
    }
    private function insertPromoterFailedAttempt($attempts)
    {
        DB::table('promoters_failed_attempts')->updateOrInsert(
            [
                'ip_address' => request()?->ip(),
            ],
            [
                'attempts' => $attempts,
                'updated_at' => now()
            ]
        );
    }


}
