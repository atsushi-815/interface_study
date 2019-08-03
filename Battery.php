<?php

//interfaceにはfunction名、引数、返り値しか記載しない。（引数、返り値は場合によりけり）
interface Battery
{
    //引数int型で取得、返り値もint型指定
    public function charge(int $minutes): int;
}

//interfaceの実装には「extends」ではなく「implements」というキーワードを使用
class GoodBattery implements Battery
{
    public function charge(int $minutes): int
    {
        return 5 * $minutes;
    }
}


class BadBattery implements Battery
{
    public function charge(int $minutes): int
    {
        return 1 * $minutes;
    }
}

class Robot
{
    //protectedはそのクラス自身と継承クラスからアクセス可能
    protected $battery;
    protected $power = 0;

    //メソッド名の部分を__constructとすると、それがコンストラクタとなる
    public function __construct(Battery $battery)
    {
        $this->battery = $battery;
    }

    public function charge(int $minutes)
    {
        $this->power = $this->battery->charge($minutes);
    }

    public function walk()
    {
        for ($i = 0; $i < $this->power; $i++) {
            echo 'トコ';
        }
    
        echo PHP_EOL;
    
        $this->power = 0;
    }
}

$bad_battery = new BadBattery;
$robot = new Robot($bad_battery);
$robot->charge(10);
$robot->walk();

$good_battery = new GoodBattery;
$robot2 = new Robot($good_battery);
$robot2->charge(10);
$robot2->walk();