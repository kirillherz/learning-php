<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './vendor/autoload.php';

        interface IMessage {

            public function getMessage();
        }

        class HelloMessage implements IMessage {

            public function getMessage() {
                return "hello";
            }

        }

        interface IShow {

            public function setMessage(IMessage $message);

            public function show();
        }

        class Show implements IShow {

            private $message;

            public function setMessage(IMessage $message) {
                $this->message = $message;
            }

            public function show() {
                if ($this->message == NULL) {
                    throw Exception("message is NULL");
                } else {
                    echo $this->message;
                }
            }

        }

        $injector = new phemto\Phemto();
        $injector->forType("Show")->call("setMessage");
        $show = $injector->create("Show");
        $show->show();
        ?>
    </body>
</html>
