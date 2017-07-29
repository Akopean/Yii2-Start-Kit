<?php
foreach(Yii::$app->session->getAllFlashes() as $type => $messages):
     foreach($messages as $message):
        ;
        if(!is_array($message) && $json_message = json_decode($message)):
            foreach($json_message as $m):
                echo  '<div class="alert alert-' . $type . '" role="alert">' . $m[0] . '</div>';
            endforeach;
        else:
            echo  '<div class="alert alert-' . $type . '" role="alert">' . $message . '</div>';
        endif;
     endforeach;
endforeach;