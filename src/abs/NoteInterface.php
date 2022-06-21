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
// | Version: 2.0 2021/3/17 15:44
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\abs;

interface NoteInterface
{
    function test(): int;

    function syncLogin($param): int;

    function syncLogout($param): int;

    function createUser($param): int;

    function updateUser($param): int;

    function deleteUser($param): int;
}
