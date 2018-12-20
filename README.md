Laravel validators for base64 encoded images.

## Requirements

* PHP: 7.1+
* Laravel: 5.5+

## Install

* Install composer package to your laravel application
``` bash
$ composer require harishpatel143/laravel-base64-validation
```

## Uses
Use base64 image validation rule as usual Laravel validation rules. Base64 rule variants supports all parameters from their original Laravel rules.

### In Form Request
 ```php
public function rules(): array
{
        return [
            'avatar' => 'base64image',
        ];
}
```


### In Controller
 ```php
protected function validator(array $data)
{
        return Validator::make($data, [
            'avatar' => ['base64image'],
        ]);
}
```






