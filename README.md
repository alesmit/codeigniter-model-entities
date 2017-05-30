# CodeIgniter Model Entities

This library provides a schema-based solution to perform CRUD (**C**reate **R**ead **U**pdate and **D**elete) operations on your CodeIgniter models and persist them to db.

Let your models extend `MY_Model` to save time writing Query Builder statements inside of each CI model! A model would just contain its properties to be ready for db operations.

## Usage

Here's an example of your model:

```php
class User extends MY_Model {

    // REQUIRED: This is the table mapped to this class
    public $table = 'users';

    /*
     * Table fields
     */

    public $id; // required

    public $first_name;
    public $last_name;

}
```

Done! We're ready to go.

### Saving data
```php
// if is a new user (insert)
$user = new User();

// if is an existing one (update)
$user = $this->User->getByID(1);

// fill properties
$user->first_name = 'Mike';
$user->last_name = 'Shinoda';

// save it
$user = $user->save();
```

### Removing data
```php
// get user by id and delete it
$user = $this->User->getByID(1);
$deleted = $user->remove();
```

### Select methods
Each model which extends from **MY_Model** will inherit the following methods:

#### findByAttributes(...)

Will return a model instance matching the attributes you pass as first argument. They will be in AND condition.
To perform more complex selects, use the Query Builder class.

```php
// select * from users where first_name = 'Mike'
$mike = $this->User->findByAttributes(array('first_name' => 'Mike'));
```

#### findAllByAttributes(...)

Will return an array of model instances matching the attributes you pass as first argument.

```php
// select * from users where country = 'Italy'
$ita_users = $this->User->findAllByAttributes(array('country' => 'Italy'));
```

#### getByID($id)

To get a model instance by his `id`.

```php
// select * from users id = 1
$user = $this->User->getByID(1);
```

#### getAll()

Get an array of all model instances.

```php
// select * from users
$all_users = $this->User->getAll();
```

#### getLastID()

Get the higher id (mostly the last saved ID)

```php
// select max(id) from users
$higher_id = $this->User->getLastID();
```

## Contributing

Contributions are welcome. Feel free to improve and extend this library.

Commit to master branch and use pull requests.
