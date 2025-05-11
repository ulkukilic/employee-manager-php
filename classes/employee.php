<?php
class Employee {
    public string $name;
    public string $email;
    public float  $salary;
    public DateTime $hiredDate;

    public function __construct(string $name, string $email, float $salary, DateTime $hiredDate) {
        $this->name      = $name;
        $this->email     = $email;
        $this->salary    = $salary;
        $this->hiredDate = $hiredDate;
    }

    public function getInfo(): string {
        return "{$this->name} ({$this->email}) — "
             . number_format($this->salary, 2) . "₺,  "
             . $this->hiredDate->format('Y-m-d');
    }
}
