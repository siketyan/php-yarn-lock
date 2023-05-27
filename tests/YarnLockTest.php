<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

use PHPUnit\Framework\TestCase;

class YarnLockTest extends TestCase
{
    public function testYarn1x(): void
    {
        $lock = file_get_contents(__DIR__ . '/examples/yarn-1.x/yarn.lock');

        $expected = [
            '@types/node@^18' => [
                'version' => '18.16.16',
                'resolved' => 'https://registry.yarnpkg.com/@types/node/-/node-18.16.16.tgz#3b64862856c7874ccf7439e6bab872d245c86d8e',
                'integrity' => 'sha512-NpaM49IGQQAUlBhHMF82QH80J08os4ZmyF9MkpCzWAGuOHqE4gTEbhzd7L3l5LmWuZ6E0OiC1FweQ4tsiW35+g==',
            ],
            'typescript@^5' => [
                'version' => '5.0.4',
                'resolved' => 'https://registry.yarnpkg.com/typescript/-/typescript-5.0.4.tgz#b217fd20119bd61a94d4011274e0ab369058da3b',
                'integrity' => 'sha512-cW9T5W9xY37cc+jfEnaUvX91foxtHkza3Nw3wkoF4sSlKn0MONdkdEndig/qPBWXNkmplh3NzayQzCiHM4/hqw==',
            ],
        ];

        $actual = YarnLock::parse($lock);
        $crlf = YarnLock::parse(str_replace("\n", "\r\n", $lock));

        $this->assertSame($expected, $actual);
        $this->assertSame($expected, $crlf);
    }

    public function testYarn24(): void
    {
        $lock = file_get_contents(__DIR__ . '/examples/yarn-2.4/yarn.lock');

        $expected = [
            '__metadata' => [
                'version' => 4,
                'cacheKey' => 7,
            ],
            '@types/node@npm:^18' => [
                'version' => '18.16.16',
                'resolution' => '@types/node@npm:18.16.16',
                'checksum' => '542a83a9883af18d13ec13483558b709a20da9df3f159defc56d8520c7385b2e71e19d5d6b82c45feefadae3f33e978715cc4c7f0e720899cae6141213fbc9db',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
            'root-workspace-0b6124@workspace:.' => [
                'version' => '0.0.0-use.local',
                'resolution' => 'root-workspace-0b6124@workspace:.',
                'dependencies' => [
                    '@types/node' => '^18',
                    'typescript' => '4.4.4',
                ],
                'languageName' => 'unknown',
                'linkType' => 'soft',
            ],
            'typescript@4.4.4' => [
                'version' => '4.4.4',
                'resolution' => 'typescript@npm:4.4.4',
                'bin' => [
                    'tsc' => 'bin/tsc',
                    'tsserver' => 'bin/tsserver',
                ],
                'checksum' => '8c5455b860a69f05d4730f54bcd0c380dae34bb1ae1b0d6ac5f16fb9d3c445834dff563eccc8c970cd15e7c9d2aa8183851a0d35d62bac1e24260bf805c23af4',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
            'typescript@patch:typescript@4.4.4#builtin<compat/typescript>' => [
                'version' => '4.4.4',
                'resolution' => 'typescript@patch:typescript@npm%3A4.4.4#builtin<compat/typescript>::version=4.4.4&hash=8133ad',
                'bin' => [
                    'tsc' => 'bin/tsc',
                    'tsserver' => 'bin/tsserver',
                ],
                'checksum' => 'd1c6c0a705893112dc19979fa58dd96b1b9395bf4cb9b013bdfe4badb31320c39187f2ff6088568e6742b66624c1bcf49c8d7ef1f443fbd64d4225752c09f065',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
        ];

        $actual = YarnLock::parse($lock);
        $crlf = YarnLock::parse(str_replace("\n", "\r\n", $lock));

        $this->assertSame($expected, $actual);
        $this->assertSame($expected, $crlf);
    }

    public function testYarn35(): void
    {
        $lock = file_get_contents(__DIR__ . '/examples/yarn-3.5/yarn.lock');

        $expected = [
            '__metadata' => [
                'version' => 6,
                'cacheKey' => 8,
            ],
            '@types/node@npm:^18' => [
                'version' => '18.16.16',
                'resolution' => '@types/node@npm:18.16.16',
                'checksum' => '0efad726dd1e0bef71c392c708fc5d78c5b39c46b0ac5186fee74de4ccb1b2e847b3fa468da67d62812f56569da721b15bf31bdc795e6c69b56c73a45079ed2d',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
            'root-workspace-0b6124@workspace:.' => [
                'version' => '0.0.0-use.local',
                'resolution' => 'root-workspace-0b6124@workspace:.',
                'dependencies' => [
                    '@types/node' => '^18',
                    'typescript' => '^5',
                ],
                'languageName' => 'unknown',
                'linkType' => 'soft',
            ],
            'typescript@npm:^5' => [
                'version' => '5.0.4',
                'resolution' => 'typescript@npm:5.0.4',
                'bin' => [
                    'tsc' => 'bin/tsc',
                    'tsserver' => 'bin/tsserver',
                ],
                'checksum' => '82b94da3f4604a8946da585f7d6c3025fff8410779e5bde2855ab130d05e4fd08938b9e593b6ebed165bda6ad9292b230984f10952cf82f0a0ca07bbeaa08172',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
            'typescript@patch:typescript@^5#~builtin<compat/typescript>' => [
                'version' => '5.0.4',
                'resolution' => 'typescript@patch:typescript@npm%3A5.0.4#~builtin<compat/typescript>::version=5.0.4&hash=b5f058',
                'bin' => [
                    'tsc' => 'bin/tsc',
                    'tsserver' => 'bin/tsserver',
                ],
                'checksum' => 'd26b6ba97b6d163c55dbdffd9bbb4c211667ebebc743accfeb2c8c0154aace7afd097b51165a72a5bad2cf65a4612259344ff60f8e642362aa1695c760d303ac',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
        ];

        $actual = YarnLock::parse($lock);
        $crlf = YarnLock::parse(str_replace("\n", "\r\n", $lock));

        $this->assertSame($expected, $actual);
        $this->assertSame($expected, $crlf);
    }
}
