<?php

namespace App\Http\Controllers\API\V1\User\List;

use App\Http\Controllers\Controller;
use App\Library\Http\Response\JsonResponse;

class GetUserListController extends Controller
{
    public function getUserList(): JsonResponse
    {
        return new JsonResponse(['data' => [
            ['id' => 1, 'name' => 'tanaka', 'icon' => 'https://free-designer.net/design_img/1024043005.jpg'],
            ['id' => 2, 'name' => 'ito', 'icon' => 'https://free-designer.net/design_img/1229010007.jpg'],
            ['id' => 3, 'name' => 'yashiro', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
            ['id' => 4, 'name' => 'yossi', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
            ['id' => 5, 'name' => 'take', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
            ['id' => 6, 'name' => 'honda', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
            ['id' => 7, 'name' => 'issi', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
        ]]);
    }
}
