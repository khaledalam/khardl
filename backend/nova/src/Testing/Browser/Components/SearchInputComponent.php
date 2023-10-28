<?php

namespace Laravel\Nova\Testing\Browser\Components;

use Illuminate\Support\Arr;
use Laravel\Dusk\Browser;
use Laravel\Nova\Testing\Browser\Searchable;

class SearchInputComponent extends Component
{
    public $attribute;

    /**
     * Create a new component instance.
     *
     * @param  string  $attribute
     * @return void
     */
    public function __construct(string $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * Search for the given value for a searchable field attribute.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $search
     * @return void
     */
    public function searchInput(Browser $browser, $search)
    {
        $input = $browser->element('input');

        if (is_null($input) || ! $input->isDisplayed()) {
            $browser->click('')->pause(100);
        }

        $browser->type('input', $search);
    }

    /**
     * Reset the searchable field.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function resetSearchResult(Browser $browser)
    {
        $this->cancelSelectingSearchResult($browser);

        $browser->click("{$this->selector()}-clear-button")->pause(150);
    }

    /**
     * Search and select the searchable field by result index.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $search
     * @param  int  $resultIndex
     * @return void
     */
    public function searchAndSelectResult(Browser $browser, $search, $resultIndex)
    {
        $this->searchInput($browser, $search);

        $browser->pause(1500)->assertValue('input', $search);

        $this->selectSearchResult($browser, $resultIndex);
    }

    /**
     * Select the searchable field by result index.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  int  $resultIndex
     * @return void
     */
    public function selectSearchResult(Browser $browser, $resultIndex)
    {
        $browser->click("{$this->selector()}-result-{$resultIndex}")->pause(150);
    }

    /**
     * Select the currently highlighted searchable field.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function cancelSelectingSearchResult(Browser $browser)
    {
        $input = $browser->element('input');

        if (! is_null($input) && $input->isDisplayed()) {
            $browser->keys('input', '{escape}')->pause(150);
        }
    }

    /**
     * Select the currently highlighted searchable field.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function selectFirstSearchResult(Browser $browser)
    {
        $this->selectSearchResult($browser, 0);
    }

    /**
     * Search and select the currently highlighted searchable relation.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $search
     * @return void
     */
    public function searchFirstRelation(Browser $browser, $search)
    {
        $this->searchAndSelectFirstResult($browser, $search);
    }

    /**
     * Search and select the currently highlighted searchable field.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $search
     * @return void
     */
    public function searchAndSelectFirstResult(Browser $browser, $search)
    {
        $this->searchAndSelectResult($browser, $search, 0);
    }

    /**
     * Assert on searchable results.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  callable(\Laravel\Nova\Browser, string):void  $fieldCallback
     * @return void
     */
    public function assertSearchResult(Browser $browser, callable $fieldCallback)
    {
        $browser->click('')
            ->pause(100)
            ->elsewhere('', function ($browser) use ($fieldCallback) {
                $fieldCallback($browser, $this->selector());
            });

        $this->cancelSelectingSearchResult($browser);
    }

    /**
     * Assert on searchable results is locked to single result.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $search
     * @return void
     */
    public function assertSelectedResult(Browser $browser, $search)
    {
        $browser->assertSeeIn("{$this->selector()}-selected", $search);
    }

    /**
     * Assert on searchable results is locked to single result.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $search
     * @return void
     */
    public function assertSelectedSearchResult(Browser $browser, $search)
    {
        $this->assertSelectedResult($browser, $search);

        $this->assertSearchResult($browser, function ($browser, $attribute) use ($search) {
            $browser->assertSeeIn("{$attribute}-result-0", $search)
                        ->assertNotPresent("{$attribute}-result-1")
                        ->assertNotPresent("{$attribute}-result-2")
                        ->assertNotPresent("{$attribute}-result-3")
                        ->assertNotPresent("{$attribute}-result-4");
        });
    }

    /**
     * Assert on searchable results is empty.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function assertEmptySearchResult(Browser $browser)
    {
        $this->assertSearchResult($browser, function ($browser, $attribute) {
            $browser->assertNotPresent("{$attribute}-result-0")
                ->assertNotPresent("{$attribute}-result-1")
                ->assertNotPresent("{$attribute}-result-2")
                ->assertNotPresent("{$attribute}-result-3")
                ->assertNotPresent("{$attribute}-result-4");
        });
    }

    /**
     * Assert on searchable results has the search value.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string|array  $search
     * @return void
     */
    public function assertSearchResultContains(Browser $browser, $search)
    {
        $this->assertSearchResult($browser, function ($browser, $attribute) use ($search) {
            foreach (Arr::wrap($search) as $keyword) {
                $browser->assertSeeIn("{$attribute}-results", $keyword);
            }
        });
    }

    /**
     * Assert on searchable results doesn't has the search value.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string|array  $search
     * @return void
     */
    public function assertSearchResultDoesNotContains(Browser $browser, $search)
    {
        $this->assertSearchResult($browser, function ($browser, $attribute) use ($search) {
            foreach (Arr::wrap($search) as $keyword) {
                $browser->assertDontSeeIn("{$attribute}-results", $keyword);
            }
        });
    }

    /**
     * Get the root selector associated with this component.
     *
     * @return string
     */
    public function selector()
    {
        return "@{$this->attribute}-search-input";
    }
}
