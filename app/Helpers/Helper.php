<?php
namespace App\Helpers;

use App\Libraries\Address;

class Helper 
{
    public $count;
    public static function renderMultilevelHtml($categories, $parent_id = 0, $char = '')
    {
        $user = auth()->user();
        global $count;
        $html = '';
        foreach ($categories as $key => $cat) {
            if ($cat->parent_id == $parent_id) {
                $count++;
                $html .= '<tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-category.html" class="symbol symbol-50px">
                                        <span class="symbol-label" style="background-image:url(' . $cat->thumb . ');"></span>
                                    </a>
                                    <div class="ms-5">
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-category.html" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1" data-kt-ecommerce-category-filter="category_name">' . $char . ' ' . $cat->name . '</a>
                                        <div class="text-muted fs-7 fw-bolder" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">' . $cat->description . '</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-light-' . self::renderStatusColor($cat->active) . '">' . self::renderStatus($cat->active) . '</div>
                            </td>
                            <td class="text-end">';
                if ($user->can('category_product.update')) {
                    $html .= '<button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 update-btn" data-name="' . $cat->name . '" data-id="' . $cat->id . '" title="'. __('common.update') .'">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                            fill="currentColor" />
                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </button>';
                }
                if ($user->can('category_product.delete')) {
                    $html .= '<button class="btn btn-icon btn-active-light-primary w-30px h-30px delete-btn" data-name="' . $cat->name . '" data-id="' . $cat->id . '" title="' . __('common.delete') . '"
                                data-kt-permissions-table-filter="delete_row">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                            fill="currentColor" />
                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                            fill="currentColor" />
                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </button>';
                }
                $html .= '</td></tr>';
                unset($categories[$key]);
                $html .= self::renderMultilevelHtml($categories, $cat->id, $char . '--');
            }
        }
        return $html;
    }

    public static function renderMultilevelOption($categories, $parent_id = 0, $char = '', $id = -1)
    {
        $html = '';
        foreach ($categories as $key => $cat) {
            if ($cat->parent_id == $parent_id) {
                $html .= '<option value="' . $cat->id . '"' . ($cat->id == $id ? 'selected' : '') . '>' . $char . ' ' . $cat->name . '</option>';
                unset($categories[$key]);
                $html .= self::renderMultilevelOption($categories, $cat->id, $char . '--', $id);
            }
        }
        return $html;
    }

    public static function renderStatus($status)
    {
        if ($status) {
            return trans('common.active');
        }
        return trans('common.inactive');
    }

    public static function renderStatusColor($status)
    {
        switch ($status) {
            case 0:
                return 'danger';
                break;
            case 1:
                return 'success';
                break;
            default:
                return 'information';
        }
    }

    public static function getDetailAddress()
    {
        $addressApi = new Address();
        $address = $addressApi->getAddress();
        $address = collect($address)->keyBy('code')->map(function($province) {
            $province->districts = collect($province->districts)->keyBy('code')->map(function($district) {
                $district->wards = collect($district->wards)->keyBy('code');
                return $district;
            });
            return $province;
        });
        return $address;
    } 
}