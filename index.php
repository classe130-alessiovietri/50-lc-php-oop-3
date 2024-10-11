<?php

// class SpecialData {

//     public $name;
//     public $email;

// }

// class User extends SpecialData {

//     public $birthDate;

// }

// class Category {

//     public $name;
//     public $active;

// }

// class Company extends SpecialData {

//     public $address;
//     public $phone;

// }

// class WithName {

//     protected $name;

//     public function getName() {
//         return $this->name;
//     }

//     public function setName(string $name) {
//         if (strlen($name) >= 3) {
//             $this->name = $name;
//         }
//         else {
//             $this->name = null;
//         }
//     }

// }

// class WithEmail {

//     protected $email;

//     public function getEmail() {
//         return $this->email;
//     }

//     public function setEmail(string $email) {
//         if (strlen($email) >= 3) {
//             $this->email = $email;
//         }
//         else {
//             $this->email = null;
//         }
//     }

// }

// class User extends WithName {

//     public $email;
//     public $birthDate;

// }

// class Category extends WithName {

//     public $active;

// }

// class Company extends WithName {

//     public $email;
//     public $address;
//     public $phone;

// }

trait HasName {

    protected $name;

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        if (strlen($name) >= 3) {
            $this->name = $name;
        }
        else {
            $this->name = null;
        }
    }

}

trait HasEmail {

    protected $email;

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) {
        if (
            strlen($email) >= 5
            &&
            strlen($email) < 256
        ) {
            $this->email = $email;
        }
        else if (strlen($email) == 1) {
            throw new EmailTooShortError('email troppo corta. Deve essere almeno 5 caratteri');
        }
        else {
            $this->email = null;
        }
    }

}

class EmailTooShortError extends Exception {

}

class BirthDateError extends Exception {

}

class User {

    use HasName;
    use HasEmail;

    public $birthDate;

    function __construct(string $name, string $email, string $birthDate) {
        $this->setName($name);
        $this->setEmail($email);

        if (
            is_string($birthDate)
            &&
            strlen($birthDate) == 10
        ) {
            $this->birthDate = $birthDate;
        }
        else {
            throw new BirthDateError('data di nascita non valida. Meno di 10 caratteri passati');
        }
    }

}

class Category {

    use HasName;

    public $active;

}

class Company {

    use HasName;
    use HasEmail;
    
    public $address;
    public $phone;

}

try {
    $user = new User('Mario', 'mario@boolean.careers', $_GET['birthDate']);

    var_dump($user);
}
catch(EmailTooShortError $ciccio) {
    var_dump($ciccio);
    echo '<h4 style="color: red;">ERRORE EMAIL: '.$ciccio->getMessage().'</h4>';
}
catch(BirthDateError $e) {
    var_dump($e);
    echo '<h4 style="color: red;">ERRORE DATA DI NASCITA: '.$e->getMessage().'</h4>';
}
catch(Exception $e) {
    echo '<h4 style="color: red;">ERRORE: '.$e->getMessage().'</h4>';
}

$category = new Category();
$company = new Company();

var_dump($category);
var_dump($company);

?>

<script>

    axios
        .get('https://google.com')
        .then(res => {
            // ...
        })
        .catch(err => {
            // Gestisco l'errore...
        });

    try {
        const num = 'ciao' * 4;
    }
    catch (err) {
        console.log(err);
    }

</script>