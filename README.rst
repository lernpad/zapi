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
    use Lernpad\ZApi\Model\StatusMsg;
    use Lernpad\ZApi\Model\UserMsg;
    use Lernpad\ZApi\Model\EventMsg;

    $authUser = new UserMsg();
    $authUser->setLogin(2);
    $authUser->setPassword('PhnOpwAS');

    // Client Api service
    $cp = new ClientProtocol();
    $cp->connect('10.10.10.10', 1234, $authUser);

    //--- Try to create new User
    $newUser = new UserMsg();
    $newUser->setLogin(1068);
    $newUser->setPassword('12345678');
    $newUser->setGroup(0);
    $newUser->setName('Ivan Urgant');
    $newUser->setEnabled(true);

    $status = $cp->userCreate($newUser);
    echo "new user status(".$status.",".StatusMsg::getName($status).")\n";

Check if User exists
.. code-block:: php

    $status = $cp->userGet($newLogin);
    echo "get user status(".$status.",".StatusMsg::getName($status).")\n";

Try to get EventCalendar
.. code-block:: php

    $events = $cp->eventsGet();
    /* @var $item EventMsg */
    foreach ($events as $item) {
        echo $item->getDatetime().",".$item->getTitle()."\n";
    }

Change User password
.. code-block:: php

    $status = $cp->userPassword($newLogin, "foobar");
    echo "password status(".$status.",".StatusMsg::getName($status).")\n";

Change User service
.. code-block:: php

    $status = $cp->userService($newLogin, new \DateTime('+3 month'));
    echo "service status(".$status.",".StatusMsg::getName($status).")\n";