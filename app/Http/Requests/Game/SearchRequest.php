<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 26.06.2019
 * Time: 10:16
 */

namespace App\Http\Requests\Game;

use App\Http\Requests\Request;

/**
 * Class SearchRequest
 * @package App\Http\Requests\Game
 */
class SearchRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'        => 'nullable|integer',
            'name'      => 'nullable|string',
            'date_from' => 'nullable|string',
            'date_to'   => 'nullable|string'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [

        ];
    }
}