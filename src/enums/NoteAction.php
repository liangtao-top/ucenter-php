<?php
declare(strict_types=1);
// +----------------------------------------------------------------------
// | CodeEngine
// +----------------------------------------------------------------------
// | Copyright 艾邦
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: TaoGe <liangtao.gz@foxmail.com>
// +----------------------------------------------------------------------
// | Version: 2.0 2022/6/20 17:42
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\enums;

enum NoteAction:string
{
    case TEST = 'test';
    case SYNC_LOGIN = 'syncLogin';
    case SYNC_LOGOUT = 'syncLogout';
    case CREATE_USER = 'createUser';
    case UPDATE_USER = 'updateUser';
    case DELETE_USER = 'deleteUser';
}
