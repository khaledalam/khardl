<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Administrator', 'Branch Admin', 'Casher'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
        $permissions = [
            'admin.users.add', 'admin.users.edit', 'admin.users.update', 'admin.users.delete',
            'admin.branch.add', 'admin.branch.edit', 'admin.branch.update', 'admin.branch.delete',
            'admin.address.add', 'admin.address.edit', 'admin.address.update', 'admin.address.delete',
            'admin.affiliate-profile.add', 'admin.affiliate-profile.edit', 'admin.affiliate-profile.update', 'admin.affiliate-profile.delete',
            'admin.blocklist.add', 'admin.blocklist.edit', 'admin.blocklist.update', 'admin.blocklist.delete',
            'admin.cart.add', 'admin.cart.edit', 'admin.cart.update', 'admin.cart.delete',
            'admin.cart-item.add', 'admin.cart-item.edit', 'admin.cart-item.update', 'admin.cart-item.delete',
            'admin.category.add', 'admin.category.edit', 'admin.category.update', 'admin.category.delete',
            'admin.client.add', 'admin.client.edit', 'admin.client.update', 'admin.client.delete',
            'admin.coupon.add', 'admin.coupon.edit', 'admin.coupon.update', 'admin.coupon.delete',
            'admin.customer-style.add', 'admin.customer-style.edit', 'admin.customer-style.update', 'admin.customer-style.delete',
            'admin.feedback.add', 'admin.feedback.edit', 'admin.feedback.update', 'admin.feedback.delete',
            'admin.most-question.add', 'admin.most-question.edit', 'admin.most-question.update', 'admin.most-question.delete',
            'admin.notification.add', 'admin.notification.edit', 'admin.notification.update', 'admin.notification.delete',
            'admin.order.add', 'admin.order.edit', 'admin.order.update', 'admin.order.delete',
            'admin.order-item.add', 'admin.order-item.edit', 'admin.order-item.update', 'admin.order-item.delete',
            'admin.payment.add', 'admin.payment.edit', 'admin.payment.update', 'admin.payment.delete',
            'admin.payment-method.add', 'admin.payment-method.edit', 'admin.payment-method.update', 'admin.payment-method.delete',
            'admin.product.add', 'admin.product.edit', 'admin.product.update', 'admin.product.delete',
            'admin.product-extra.add', 'admin.product-extra.edit', 'admin.product-extra.update', 'admin.product-extra.delete',
            'admin.product-image.add', 'admin.product-image.edit', 'admin.product-image.update', 'admin.product-image.delete',
            'admin.product-size.add', 'admin.product-size.edit', 'admin.product-size.update', 'admin.product-size.delete',
            'admin.restaurant.add', 'admin.restaurant.edit', 'admin.restaurant.update', 'admin.restaurant.delete',
            'admin.restaurant-setting.add', 'admin.restaurant-setting.edit', 'admin.restaurant-setting.update', 'admin.restaurant-setting.delete',
            'admin.restaurant-style.add', 'admin.restaurant-style.edit', 'admin.restaurant-style.update', 'admin.restaurant-style.delete',
            'admin.restaurant-subscribe.add', 'admin.restaurant-subscribe.edit', 'admin.restaurant-subscribe.update', 'admin.restaurant-subscribe.delete',
            'admin.review.add', 'admin.review.edit', 'admin.review.update', 'admin.review.delete',
            'admin.sale.add', 'admin.sale.edit', 'admin.sale.update', 'admin.sale.delete',
            'admin.shipment.add', 'admin.shipment.edit', 'admin.shipment.update', 'admin.shipment.delete',
            'admin.subscription.add', 'admin.subscription.edit', 'admin.subscription.update', 'admin.subscription.delete',
            'admin.system-log.add', 'admin.system-log.edit', 'admin.system-log.update', 'admin.system-log.delete',
            'admin.tag.add', 'admin.tag.edit', 'admin.tag.update', 'admin.tag.delete',
            'admin.tenant.add', 'admin.tenant.edit', 'admin.tenant.update', 'admin.tenant.delete',
            'admin.transaction.add', 'admin.transaction.edit', 'admin.transaction.update', 'admin.transaction.delete',
            'admin.whishlist.add', 'admin.whishlist.edit', 'admin.whishlist.update', 'admin.whishlist.delete',
            'admin.domain.add', 'admin.domain.edit', 'admin.domain.update', 'admin.domain.delete'
        ];
        // Create each permission
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        // Assign all permissions to the 'Administrator' role
        $adminRole = Role::findByName('Administrator');
        $adminRole->givePermissionTo($permissions);

        
    }
}
