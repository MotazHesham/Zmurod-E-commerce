<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_create',
            ],
            [
                'id'    => 18,
                'title' => 'product_edit',
            ],
            [
                'id'    => 19,
                'title' => 'product_show',
            ],
            [
                'id'    => 20,
                'title' => 'product_delete',
            ],
            [
                'id'    => 21,
                'title' => 'product_access',
            ],
            [
                'id'    => 22,
                'title' => 'course_create',
            ],
            [
                'id'    => 23,
                'title' => 'course_edit',
            ],
            [
                'id'    => 24,
                'title' => 'course_show',
            ],
            [
                'id'    => 25,
                'title' => 'course_delete',
            ],
            [
                'id'    => 26,
                'title' => 'course_access',
            ],
            [
                'id'    => 27,
                'title' => 'traders_forum_access',
            ],
            [
                'id'    => 28,
                'title' => 'froum_create',
            ],
            [
                'id'    => 29,
                'title' => 'froum_edit',
            ],
            [
                'id'    => 30,
                'title' => 'froum_show',
            ],
            [
                'id'    => 31,
                'title' => 'froum_delete',
            ],
            [
                'id'    => 32,
                'title' => 'froum_access',
            ],
            [
                'id'    => 33,
                'title' => 'post_create',
            ],
            [
                'id'    => 34,
                'title' => 'post_edit',
            ],
            [
                'id'    => 35,
                'title' => 'post_show',
            ],
            [
                'id'    => 36,
                'title' => 'post_delete',
            ],
            [
                'id'    => 37,
                'title' => 'post_access',
            ],
            [
                'id'    => 38,
                'title' => 'comment_create',
            ],
            [
                'id'    => 39,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 40,
                'title' => 'comment_show',
            ],
            [
                'id'    => 41,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 42,
                'title' => 'comment_access',
            ],
            [
                'id'    => 43,
                'title' => 'blogs_managment_access',
            ],
            [
                'id'    => 44,
                'title' => 'blog_create',
            ],
            [
                'id'    => 45,
                'title' => 'blog_edit',
            ],
            [
                'id'    => 46,
                'title' => 'blog_show',
            ],
            [
                'id'    => 47,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 48,
                'title' => 'blog_access',
            ],
            [
                'id'    => 49,
                'title' => 'customer_service_access',
            ],
            [
                'id'    => 50,
                'title' => 'message_create',
            ],
            [
                'id'    => 51,
                'title' => 'message_edit',
            ],
            [
                'id'    => 52,
                'title' => 'message_show',
            ],
            [
                'id'    => 53,
                'title' => 'message_delete',
            ],
            [
                'id'    => 54,
                'title' => 'message_access',
            ],
            [
                'id'    => 55,
                'title' => 'general_setting_access',
            ],
            [
                'id'    => 56,
                'title' => 'slider_create',
            ],
            [
                'id'    => 57,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 58,
                'title' => 'slider_show',
            ],
            [
                'id'    => 59,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 60,
                'title' => 'slider_access',
            ],
            [
                'id'    => 61,
                'title' => 'banner_create',
            ],
            [
                'id'    => 62,
                'title' => 'banner_edit',
            ],
            [
                'id'    => 63,
                'title' => 'banner_show',
            ],
            [
                'id'    => 64,
                'title' => 'banner_delete',
            ],
            [
                'id'    => 65,
                'title' => 'banner_access',
            ],
            [
                'id'    => 66,
                'title' => 'product_managment_access',
            ],
            [
                'id'    => 67,
                'title' => 'category_create',
            ],
            [
                'id'    => 68,
                'title' => 'category_edit',
            ],
            [
                'id'    => 69,
                'title' => 'category_show',
            ],
            [
                'id'    => 70,
                'title' => 'category_delete',
            ],
            [
                'id'    => 71,
                'title' => 'category_access',
            ],
            [
                'id'    => 72,
                'title' => 'seller_create',
            ],
            [
                'id'    => 73,
                'title' => 'seller_edit',
            ],
            [
                'id'    => 74,
                'title' => 'seller_show',
            ],
            [
                'id'    => 75,
                'title' => 'seller_delete',
            ],
            [
                'id'    => 76,
                'title' => 'seller_access',
            ],
            [
                'id'    => 77,
                'title' => 'tag_create',
            ],
            [
                'id'    => 78,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 79,
                'title' => 'tag_show',
            ],
            [
                'id'    => 80,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 81,
                'title' => 'tag_access',
            ],
            [
                'id'    => 82,
                'title' => 'review_create',
            ],
            [
                'id'    => 83,
                'title' => 'review_edit',
            ],
            [
                'id'    => 84,
                'title' => 'review_show',
            ],
            [
                'id'    => 85,
                'title' => 'review_delete',
            ],
            [
                'id'    => 86,
                'title' => 'review_access',
            ],
            [
                'id'    => 87,
                'title' => 'about_us_create',
            ],
            [
                'id'    => 88,
                'title' => 'about_us_edit',
            ],
            [
                'id'    => 89,
                'title' => 'about_us_show',
            ],
            [
                'id'    => 90,
                'title' => 'about_us_delete',
            ],
            [
                'id'    => 91,
                'title' => 'about_us_access',
            ],
            [
                'id'    => 92,
                'title' => 'order_managment_access',
            ],
            [
                'id'    => 93,
                'title' => 'order_create',
            ],
            [
                'id'    => 94,
                'title' => 'order_edit',
            ],
            [
                'id'    => 95,
                'title' => 'order_show',
            ],
            [
                'id'    => 96,
                'title' => 'order_delete',
            ],
            [
                'id'    => 97,
                'title' => 'order_access',
            ],
            [
                'id'    => 98,
                'title' => 'cart_create',
            ],
            [
                'id'    => 99,
                'title' => 'cart_edit',
            ],
            [
                'id'    => 100,
                'title' => 'cart_show',
            ],
            [
                'id'    => 101,
                'title' => 'cart_delete',
            ],
            [
                'id'    => 102,
                'title' => 'cart_access',
            ],
            [
                'id'    => 103,
                'title' => 'order_product_create',
            ],
            [
                'id'    => 104,
                'title' => 'order_product_edit',
            ],
            [
                'id'    => 105,
                'title' => 'order_product_show',
            ],
            [
                'id'    => 106,
                'title' => 'order_product_delete',
            ],
            [
                'id'    => 107,
                'title' => 'order_product_access',
            ],
            [
                'id'    => 108,
                'title' => 'area_create',
            ],
            [
                'id'    => 109,
                'title' => 'customer_create',
            ],
            [
                'id'    => 110,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 111,
                'title' => 'customer_show',
            ],
            [
                'id'    => 112,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 113,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 114,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 115,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 116,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 117,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 118,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 119,
                'title' => 'brand_create',
            ],
            [
                'id'    => 120,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 121,
                'title' => 'brand_show',
            ],
            [
                'id'    => 122,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 123,
                'title' => 'brand_access',
            ],
            [
                'id'    => 124,
                'title' => 'offer_create',
            ],
            [
                'id'    => 125,
                'title' => 'offer_edit',
            ],
            [
                'id'    => 126,
                'title' => 'offer_show',
            ],
            [
                'id'    => 127,
                'title' => 'offer_delete',
            ],
            [
                'id'    => 128,
                'title' => 'offer_access',
            ],
            [
                'id'    => 129,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 130,
                'title' => 'customer_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
