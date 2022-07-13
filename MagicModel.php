<?php

class MagicModel
{
    private string $username = '';
    private int $id = 0;
    private string $email = '';
    private string $password = '';

    public function __construct()
    {
        echo "magic CONSTRUCTOR called<br>";
    }

    public static function __callStatic($method, $arguments)
    {
        echo "magic CALLSTATIC called with method name: '$method'<br>";
        if (count($arguments) > 0) {
            echo " with arguments: '" . implode(", ", $arguments) . "'<br>";
        }
        if (!method_exists(static::class, $method)) {
            echo " but method '$method' does not exist in " . static::class . "<br>";
        }
    }

    public function __call($method, $arguments)
    {
        echo "magic CALL called with method name: '$method'<br>";
        if (count($arguments) > 0) {
            echo " with arguments: '" . implode(", ", $arguments) . "'<br>";
        }
        if (!method_exists($this, $method)) {
            $className = get_class($this);
            echo " but method '$method' does not exist in $className<br>";
        }
    }

    /**
     * @param $propertyName
     * @return mixed
     * @throws Exception
     */
    public function __get($propertyName): mixed
    {
        echo "magic GET called: '$propertyName'<br>";
        if (property_exists(get_class($this), $propertyName)) {
            return $this->{$propertyName};
        } else throw new Exception("Attribut " . $propertyName . " does not exist in class " . get_class($this));
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     * @throws Exception
     */
    public function __set(string $name, mixed $value): void
    {
        echo "magic SET called: '$name' with value: '$value'<br>";
        if (property_exists(get_class($this), $name)) {
            // $type = gettype($this->{$name});
            $this->{$name} = $value;
            // settype($this->{$name}, $type);
        } else throw new Exception("Attribute $name does not exist in class " . get_class($this));
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name): bool
    {
        echo "magic ISSET called: $name<br>";
        return isset($this->{$name});
    }

    public function __toString(): string
    {
        echo "magic TOSTRING called:<br>";
        $res = "";
        foreach (get_object_vars($this) as $name => $value) {
            $res .= "$name : $value<br>";
        }
        return $res;
    }
}
