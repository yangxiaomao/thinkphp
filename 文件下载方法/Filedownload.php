<?php 
/**
 * 下载文件
 *
 * @param 文件路径  $filepath
 * @return file
 */
function download_file($filepath) {
    //检查文件是否存在
    if (file_exists($filepath)) {
        //打开文件
        $file = fopen($filepath, "r");
        //返回的文件类型
        Header("Content-type: application/octet-stream");
        //按照字节大小返回
        Header("Accept-Ranges: bytes");
        //返回文件的大小
        Header("Accept-Length: " . filesize($filepath));
        //这里对客户端的弹出对话框，对应的文件名
        $showname = ltrim(strrchr($filepath, '/'), '/');
        Header("Content-Disposition: attachment; filename=" . $showname);
        //修改之前，一次性将数据传输给客户端
        echo fread($file, filesize($filepath));
        //修改之后，一次只传输1024个字节的数据给客户端
        //向客户端回送数据
        $buffer = 1024; //
        //判断文件是否读完
        while (!feof($file)) {
            //将文件读入内存
            $file_data = fread($file, $buffer);
            //每次向客户端回送1024个字节的数据
            echo $file_data;
        }
        fclose($file);
    } else {
        return false;
    }
}