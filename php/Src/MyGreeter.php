<?php
namespace SRC;

Class MyGreeter
{
    // 当前小时数
    private $hour;

    /**
     * @description 6AM至12AM之间时，返回 "Good morning", 12AM至6PM之间时，返回 "Good afternoon", 6PM至第二天6AM之间时，返回 "Good evening"。
     * @author 908970765@qq.com 2024-11-07
     *
     * @param int|null $hour, 数字或为空，其值对应每天的24小时 参数可选，传入参数时首先校验是否合法，参数多用于测试
     * @return string
     * @throws \Exception
     */
    public function greeting($hour = null)
    {
        if (is_null($hour)) {
            $this->hour = intval(date('H'));
        } else {
            if (is_int($hour)) {
                if ($hour < 0 || $hour > 24) {      // 常规认为24点是合理的，虽然24点就是0点
                    throw new \Exception('Hour should be between 0 and 24');
                }
                $this->hour = $hour;
            } else {
                throw new \Exception('Hour should be an integer');
            }
        }

        if ($this->hour >= 6 && $this->hour < 12) {
            return 'Good morning';
        } elseif ($this->hour >= 12 && $this->hour < 18) {
            return 'Good afternoon';
        } elseif ($this->hour >= 18 || $this->hour < 6) {
            return 'Good evening';
        }
    }
}
