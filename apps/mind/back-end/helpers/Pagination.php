<?php

class Pagination {
    public static function PaginationValues($page = 0, $limit = 100){
        $offset = (($page+1) * $limit)-$limit;
        return [
            "offset" => $offset,
            "limit" => $limit
        ];
    }

}