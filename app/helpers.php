<?php
if (!function_exists('success')) {
    /**
     * @param array $data
     * @param string $info
     *
     * @return \Illuminate\Http\Response
     */
    function success($data = [], $info = '成功')
    {
        if (is_string($data) && $temp = json_decode($data, 1)) {
            $data = $temp;
        }

        empty($data) && $data = (object)[];

        return response(
            [
                'iRet' => 1,
                'info' => $info,
                'data' => $data,
            ]
        );
    }
}

if (!function_exists('error')) {

    function error($info = '失败', $code = 422)
    {
        return response()->json(
            ['iRet' => 0, 'info' => $info, 'data' => []],
            $code
        );
    }
}
