<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

use PHPUnit\Framework\TestCase;

class YarnLockTest extends TestCase
{
    public function test(): void
    {
        $lock = <<<'EOS'
# THIS IS AN AUTOGENERATED FILE. DO NOT EDIT THIS FILE DIRECTLY.
# yarn lockfile v1

"@types/minimatch@*":
  version "3.0.3"
  resolved "https://registry.yarnpkg.com/@types/minimatch/-/minimatch-3.0.3.tgz#3dca0e3f33b200fc7d1139c0cd96c1268cadfd9d"
  integrity sha512-tHq6qdbT9U1IRSGf14CL0pUlULksvY9OZ+5eEgl1N7t+OA3tGvNpxJCzuKQlsNgCVwbAs670L1vcVQi8j9HjnA==

"@types/node@*", "@types/node@^14.6.0":
  version "14.6.0"
  resolved "https://registry.yarnpkg.com/@types/node/-/node-14.6.0.tgz#7d4411bf5157339337d7cff864d9ff45f177b499"
  integrity sha512-mikldZQitV94akrc4sCcSjtJfsTKt4p+e/s0AGscVA6XArQ9kFclP+ZiYUMnq987rc6QlYxXv/EivqlfSLxpKA==

"@types/webpack-sources@*":
  version "1.4.2"
  resolved "https://registry.yarnpkg.com/@types/webpack-sources/-/webpack-sources-1.4.2.tgz#5d3d4dea04008a779a90135ff96fb5c0c9e6292c"
  integrity sha512-77T++JyKow4BQB/m9O96n9d/UUHWLQHlcqXb9Vsf4F1+wKNrrlWNFPDLKNT92RJnCSL6CieTc+NDXtCVZswdTw==
  dependencies:
    "@types/node" "*"
    "@types/source-list-map" "*"
    source-map "^0.7.3"
EOS;

        $expected = [
            '@types/minimatch@*' => [
                'version' => '3.0.3',
                'resolved' => 'https://registry.yarnpkg.com/@types/minimatch/-/minimatch-3.0.3.tgz#3dca0e3f33b200fc7d1139c0cd96c1268cadfd9d',
                'integrity' => 'sha512-tHq6qdbT9U1IRSGf14CL0pUlULksvY9OZ+5eEgl1N7t+OA3tGvNpxJCzuKQlsNgCVwbAs670L1vcVQi8j9HjnA==',
            ],
            '@types/node@*,@types/node@^14.6.0' => [
                'version' => '14.6.0',
                'resolved' => 'https://registry.yarnpkg.com/@types/node/-/node-14.6.0.tgz#7d4411bf5157339337d7cff864d9ff45f177b499',
                'integrity' => 'sha512-mikldZQitV94akrc4sCcSjtJfsTKt4p+e/s0AGscVA6XArQ9kFclP+ZiYUMnq987rc6QlYxXv/EivqlfSLxpKA==',
            ],
            '@types/webpack-sources@*' => [
                'version' => '1.4.2',
                'resolved' => 'https://registry.yarnpkg.com/@types/webpack-sources/-/webpack-sources-1.4.2.tgz#5d3d4dea04008a779a90135ff96fb5c0c9e6292c',
                'integrity' => 'sha512-77T++JyKow4BQB/m9O96n9d/UUHWLQHlcqXb9Vsf4F1+wKNrrlWNFPDLKNT92RJnCSL6CieTc+NDXtCVZswdTw==',
                'dependencies' => [
                    '@types/node' => '*',
                    '@types/source-list-map' => '*',
                    'source-map' => '^0.7.3',
                ],
            ],
        ];

        $actual = YarnLock::parse($lock);
        $crlf = YarnLock::parse(str_replace("\n", "\r\n", $lock));

        $this->assertSame($expected, $actual);
        $this->assertSame($expected, $crlf);
    }
}
