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
    use Lernpad\ZApi\Exception\TimeoutException;
    use Lernpad\ZApi\Model\StatusMsg;
    use Lernpad\ZApi\Model\UserMsg;
    use Lernpad\ZApi\Model\EventMsg;
    use Symfony\Component\Validator\Exception\ValidatorException;

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

    $status = StatusMsg::statusError;
    try {
        $status = $cp->userCreate($newUser);
        echo "new user status(".$status.",".StatusMsg::getName($status).")\n";
    } catch (\ZMQSocketException $e) {
        // ...
    } catch (ValidatorException $e) {
        // ...
    } catch (TimeoutException $e) {
        // ...
    }

Check if User exists

.. code-block:: php

    $user = new UserMsg();
    $status = $cp->userGet($login, $user);
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

    $status = $cp->userPassword($login, "foobar");
    echo "password status(".$status.",".StatusMsg::getName($status).")\n";

Change User service

.. code-block:: php

    $status = $cp->userService($login, new \DateTime('+3 month'));
    echo "service status(".$status.",".StatusMsg::getName($status).")\n";

Get version of application

.. code-block:: php

    $appId = 1;
    $result = $cp->versionGet($appId);
    $code = $result['status']->getCode();
    $ver = $result['version'];
    echo "service status(".$code.",".StatusMsg::getName($code).")\n";
    /* @var $ver VersionMsg */
    echo "version " . $ver->getMajor() . '.' . $ver->getMinor() . '.' . $ver->getPatch() . " URL: " . $ver->getLink() . "\n";
