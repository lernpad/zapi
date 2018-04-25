Getting Started With ZApiBundle
====================================================

Step 1: Download ZApiBundle using composer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Require the bundle with composer:

.. code-block:: bash

    $ composer require lernpad/zapi dev-master

Step 2: Getting Started
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php

    require __DIR__.'/vendor/autoload.php';

    use Lernpad\ZApi\ClientProtocol;
    use Lernpad\ZApi\Status;
    use Lernpad\ZApi\Model\UserMsg;

    $authUser = new UserMsg();
    $authUser->setLogin(2);
    $authUser->setPassword('PhnOpwAS');

    // Client Api service
    $cp = new ClientProtocol();
    $cp->connect('10.10.10.10', 2026, $authUser);

    $newUser = new UserMsg();
    $newUser->setLogin(1061);
    $newUser->setPassword('12345678');
    $newUser->setGroup(0);
    $newUser->setName('Ivan Urgant');

    $status = $cp->userCreate($newUser);

    if($status != Status::statusOk) {
        echo "Error with status(" . $status . ")\n";
    } else {
        echo "User Created\n";
    }
