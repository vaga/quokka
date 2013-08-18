Quokka\Form
===========

Example
-------

### Controller
```php

use \Quokka\Form;

$form = new Form\Form();

$username = new Form\Element\Text('username');
$username->setRequired(true);
$form->addElement($username);

$email = new Form\Element\Email('email');
$email->setRequired(true);
$form->addElement($email);

$password = new Form\Element\Password('password');
$password->setRequired(true);
$form->addElement($password);

$country = new Form\Element\Select('country');
$country->setValue('FR');
$country->addOption('FR', 'France');
$country->addOption('DE', 'Allemagne');
$country->addOption('ES', 'Espagne');
$form->addElement($country);

if ($form->isValid($_POST)) {

    // Do something
}
```

### View
```html
<?php if ($form->hasError()): ?>
<ul>
    <?php foreach ($form->getErrors() as $error): ?>
    <li><?= $error ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<form action="" method="post">
    <p><label>Username</label><?= $form->getElement('username')->render(); ?></p>
    <p><label>Email</label><?= $form->getElement('email')->render(); ?></p>
    <p><label>Password</label><?= $form->getElement('password')->render(); ?></p>
    <p><label>Country</label><?= $form->getElement('country')->render(); ?></p>
    <p><input type="submit" name="submit-form" value="Ok" /></p>
</form>

```
