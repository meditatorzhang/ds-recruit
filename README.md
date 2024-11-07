Hello future teammate!
==========

我们用两种常见的编程语言（PHP，Python）准备了一个小测试，
你可以挑选其中一种或者其他你更自信的编程语言来完成这个测试。

动手
----

1. 希望你实现一个类（MyGreeter），满足以下条件：
  - 能够实例化。
  - 实现一个方法（让我们叫他greeting），能够根据不同的运行时间返回不同的消息字符串。
    - 当运行时间在6AM至12AM之间时，返回 "Good morning"。
    - 当运行时间在12AM至6PM之间时，返回 "Good afternoon"。
    - 当运行时间在6PM至第二天6AM之间时，返回 "Good evening"。
  - 在适当的位置编写简明扼要的注释以提高你编写的代码的可读性。

2. 希望你实现的这个类能通过我们预先准备的单元测试类（MyGreeterTest）
   - 我们准备了一个容器运行环境来供你运行单元测试，你需要根据实际情况对它进行改进，至少满足以下条件：
     - `make dev-tests` 这个命令可以在你的环境里运行。
     - 运行结果显示，所有的测试项目都正常通过。
   - 请用注释或者别的方式说明你的每个改进点的意图。
   - 如果你认为这个容器环境不存在值得改进的地方，也请提供用来支撑你这个看法的理由。

思考
----

当你完成上述动手项目后，请进一步思考并回答以下2个问题。

1. 我们准备的单元测试类（MyGreeterTest）是否存在问题？（是或者否）
2. 如果问题1你的答案"是"的话，请问有哪些问题？以及你认为针对每个问题应该如何改善？

结尾
----

当你全部完成后，请将"动手"和"思考"的结果打包提交给HR。
注意：请不要在这个代码仓库里直接提交PR！

动手
----
1. 类（MyGreeter）类代码
```
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

```

2. 改进
  * php docker 镜像未安装make, 修改后的Dockerfile如下：
```
FROM php:8.3-cli-alpine

# 安装 make 和其他可能需要的构建工具
RUN apk add --no-cache make gcc g++ \
    && apk add --no-cache alpine-sdk

WORKDIR /srv
```
 
思考
----
1. 准备的单元测试类（MyGreeterTest）需要改进
2. 原测试方法（test_greeting）只测试是否有字符串显示，未测试字符串的内容是否正确。现增加此部分，测试时间为边界值（0，6，12，18），代码如下：
```
$this->assertTrue(
    strcmp($this->greeter->greeting(0), 'Good evening') === 0
);

$this->assertTrue(
    strcmp($this->greeter->greeting(6), 'Good morning') === 0
);

$this->assertTrue(
    strcmp($this->greeter->greeting(12), 'Good afternoon') === 0
);

$this->assertTrue(
    strcmp($this->greeter->greeting(18), 'Good evening') === 0
);
```

  - 测试结果为：
```
PHPUnit 11.4.3 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.3.13
Configuration: /srv/phpunit.xml

..                                                                  2 / 2 (100%)

Time: 00:00.007, Memory: 8.00 MB

My Greeter
 ✔ Init
 ✔ Greeting

OK (2 tests, 6 assertions)

```

