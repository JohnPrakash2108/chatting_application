//<?php
    // $msg = "Hi... This is Lucky And Side is Ram Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea similique quae alias fugit incidunt illo quaerat eveniet odio, tempora fuga debitis necessitatibus maiores error unde provident vitae iste beatae! Voluptatem quo inventore animi commodi quasi impedit repellendus ut saepe magnam, omnis excepturi eos, corrupti modi quos vitae corporis doloremque unde maiores aliquam nisi ullam vero? Laudantium dolores neque dolor qui id quo, nobis rerum deleniti reprehenderit tempora architecto consequatur minima molestiae quisquam eius nostrum provident facere illo nisi impedit, dolorem perferendis, alias harum? Nostrum aut ipsam iste ratione modi deleniti voluptatem harum nihil optio neque provident illum distinctio atque suscipit deserunt, exercitationem qui recusandae possimus pariatur cupiditate expedita laudantium reprehenderit vero! Iusto minima repellat beatae numquam quisquam quod. A qui vitae nihil dignissimos tempore. Cum expedita esse perferendis repudiandae impedit, deleniti totam architecto deserunt delectus modi accusamus, accusantium ab, doloremque odit? Maiores ipsum totam eligendi dolores iure placeat, explicabo temporibus?";


    // $chiper = "aes-256-cbc-hmac-sha256";
    // $iv = 1234567891234567;
    // $key = "Hasjfhsfbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbhhhvh";
    // $key2 = "bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbhhhvh";
    // $options = 0;

    // $encrypt = openssl_encrypt($msg, $chiper, $key, $options, $iv);

    // echo $encrypt . "This is encrypted message" . strlen($msg) 


    //                                                                     $decrypt = openssl_decrypt($encrypt, $chiper, $key, $options, $iv);

    //                                                                     echo $decrypt . "This is decrypted message" . strlen($encrypt);
    //     

    echo "ok";
    $page = $_SERVER['PHP_SELF'];
    $sec = "5";
    header("Refresh: $sec; url=$page");


    ?>