Quokka\Auth
===========

Example
-------

### Authenticator
```php

use Quokka\Auth\InterfaceAuthenticator;

class AdminAuthenticator implements InterfaceAuthenticator {

    public function authenticate($identity, $credential) {

        if ($identity == 'admin' && $credential == 'mypassword') {

            return [
                'name' => 'Administrator',
                'role' => 'admin'
            ];
        }
    }
}
```

### Implementation
```php

use Quokka\Auth\Auth;

$auth = new Auth(new AdminAuthenticator());

if ($auth->authenticate($_POST['username'], $_POST['password'])) {

    echo 'You are logged in !';
}
else {

    echo 'Invalid username or password';
}

if ($auth->hasIdentity()) {

    $identity = $auth->getIdentity();
    echo 'My name is ' . $identity['name'] . ' and my role is ' . $identity['role'];
}

```
