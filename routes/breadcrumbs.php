<?php // routes/breadcrumbs.php

use App\Models\Post;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('product', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('product.products'), route('product.index'));
});

Breadcrumbs::for('product_create', function (BreadcrumbTrail $trail) {
    $trail->parent('product');
    $trail->push(trans('product.add'), route('product.create'));
});

Breadcrumbs::for('product_update', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('product');
    $trail->push($product->product_name, route('product.show', ['id' => $product->id]));
});

Breadcrumbs::for('advanced_options', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('common.advanced_options'));
});

Breadcrumbs::for('category_product', function (BreadcrumbTrail $trail) {
    $trail->parent('advanced_options');
    $trail->push(trans('common.category_product'), route('category.product.index'));
});

Breadcrumbs::for('category_product_create', function (BreadcrumbTrail $trail) {
    $trail->parent('category_product');
    $trail->push(trans('category.add'), route('category.product.create'));
});

Breadcrumbs::for('category_product_detail', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category_product');
    $trail->push($category->name, route('category.product.show', ['id' => $category->id]));
});

Breadcrumbs::for('variation', function (BreadcrumbTrail $trail) {
    $trail->parent('advanced_options');
    $trail->push(trans('common.variation'), route('variation.index'));
});

Breadcrumbs::for('brand', function (BreadcrumbTrail $trail) {
    $trail->parent('advanced_options');
    $trail->push(trans('brand.brands'), route('brand.index'));
});

Breadcrumbs::for('unit', function (BreadcrumbTrail $trail) {
    $trail->parent('advanced_options');
    $trail->push(trans('unit.units'), route('unit.index'));
});

Breadcrumbs::for('tax', function (BreadcrumbTrail $trail) {
    $trail->parent('advanced_options');
    $trail->push(trans('tax.taxes'), route('tax.index'));
});

Breadcrumbs::for('supplier', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('supply.suppliers'), route('suppliers.index'));
});

Breadcrumbs::for('purchasing', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('purchasing.purchasings'), route('purchasing.index'));
});

Breadcrumbs::for('purchasing_create', function (BreadcrumbTrail $trail) {
    $trail->parent('purchasing');
    $trail->push(trans('purchasing.create'), route('purchasing.create'));
});

Breadcrumbs::for('purchasing_update', function (BreadcrumbTrail $trail, $purchasing) {
    $trail->parent('purchasing');
    $trail->push($purchasing->purchasing_name, route('purchasing.show', ['id' => $purchasing->id]));
});

Breadcrumbs::for('purchasing_show', function (BreadcrumbTrail $trail, $purchasing) {
    $trail->parent('purchasing');
    $trail->push($purchasing->purchasing_name, route('purchasing.showInvoice', ['id' => $purchasing->id]));
});

Breadcrumbs::for('access_control', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('common.access'));
});

Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('access_control');
    $trail->push(trans('role_permission.user'), route('users.index'));
});

Breadcrumbs::for('user_detail', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('user');
    $trail->push(trans('user.user_detail'), route('users.show', ['id' => $user->id]));
});

Breadcrumbs::for('role', function (BreadcrumbTrail $trail) {
    $trail->parent('access_control');
    $trail->push(trans('role_permission.role'), route('roles.index'));
});

Breadcrumbs::for('role_detail', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('role');
    $trail->push($role->name, route('roles.show', $role->id));
});

Breadcrumbs::for('permission', function (BreadcrumbTrail $trail) {
    $trail->parent('access_control');
    $trail->push(trans('role_permission.permission'), route('permissions.index'));
});

Breadcrumbs::for('customer', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('customer.customers'), route('customers.index'));
});

Breadcrumbs::for('order', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('order.orders'), route('order.index'));
});

Breadcrumbs::for('order_create', function (BreadcrumbTrail $trail) {
    $trail->parent('order');
    $trail->push(trans('order.create'), route('order.create'));
});

Breadcrumbs::for('order_update', function (BreadcrumbTrail $trail, $order) {
    $trail->parent('order');
    $trail->push($order->name, route('order.show', ['id' => $order->id]));
});

Breadcrumbs::for('switch', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('switch.switch_user'), route('switch.index'));
});

Breadcrumbs::for('notification', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('notify.notifications'), route('notification.index'));
});