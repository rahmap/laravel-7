<?php

function alertBS($title, $message, $type)
{
    return '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>'.$title.'</strong> '.$message.'
                </div>';
}

function sweetAlert($title = '', $text = '', $type = '', $timer = 99999, $showConBtn = true)
{
    return "<script>
        let title = '$title';
        let text = '$text';
        let icon = '$type';
        let timer = '$timer';
        let showConfirmButton = '$showConBtn';
        Swal.fire({title, text, icon, showConfirmButton, timer})
        </script>";
}


function sweetAlertHref($title = '', $text = '', $type = '', $href = '')
{
    return "<script>
        let title = '$title';
        let text = '$text';
        let type = '$type';
        Swal.fire(title,text,type).then(function() {
                window.location = '$href';
            });
        </script>";
}
