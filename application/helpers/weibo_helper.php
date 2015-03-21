<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('parseSignedRequest'))
{
    function parseSignedRequest($signed_request) {

        // 将 $signed_request 参数，用小数点.分隔成数组，下标0的赋值给 $encoded_sig，下标1的复制给 $payload
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        // 对 $encoded_sig 进行 base64 解码，然后赋值给 $sig
        $sig = base64decode($encoded_sig);

        // 对 $payload 进行 base64 解码，并将字符串转为 JSON 赋值给 $data
        $data = json_decode(base64decode($payload), true);

        // 如果 $data 中的 algorithm 不是 HMAC-SHA256，表示数据校验出错，直接返回 -1
        if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') return '-1';

        // 使用 app secret 对 $payload 进行 sha256 加密
        $expected_sig = hash_hmac('sha256', $payload, '39851d4ae555b0a5b9a7e98f6ed702a9', true);

        // 如果 sha256 加密后的结果和 $sig 是一致的，那么 $data 数据就没问题，直接返回给调用方；否则>表示数据校验出错，返回 -2
        return ($sig !== $expected_sig)? '-2' : $data;
    }


    if ( ! function_exists('base64decode'))
    {
        function base64decode($str) {
            // 将需要 base64 解码的字符串，按照字符串长度先补上相应的等号（补上等号后的字符串长度应该是4>的整数倍），然后将其中的 - 和 _ 分别替换成 + 和 /，然后对处理后的字符串执行 base64 解码
            return base64_decode(strtr($str.str_repeat('=', (4 - strlen($str) % 4)), '-_', '+/'));
        }
    }
}
