[
    {
        "Id": "09c189a1c6b5a2e2b317c52df4866a9b26144e220858646a5157d9fcda31d1d0",
        "Created": "2021-04-03T12:56:12.84906558Z",
        "Path": "docker-php-entrypoint",
        "Args": [
            "php-fpm",
            "-F"
        ],
        "State": {
            "Status": "running",
            "Running": true,
            "Paused": false,
            "Restarting": false,
            "OOMKilled": false,
            "Dead": false,
            "Pid": 5745,
            "ExitCode": 0,
            "Error": "",
            "StartedAt": "2021-04-03T12:56:13.970937819Z",
            "FinishedAt": "0001-01-01T00:00:00Z"
        },
        "Image": "sha256:e944dc20f6ebdbe85e06d7e0b4b8ceabd03c3e7986931e98f150df8b6ad3a0f8",
        "ResolvConfPath": "/var/lib/docker/containers/09c189a1c6b5a2e2b317c52df4866a9b26144e220858646a5157d9fcda31d1d0/resolv.conf",
        "HostnamePath": "/var/lib/docker/containers/09c189a1c6b5a2e2b317c52df4866a9b26144e220858646a5157d9fcda31d1d0/hostname",
        "HostsPath": "/var/lib/docker/containers/09c189a1c6b5a2e2b317c52df4866a9b26144e220858646a5157d9fcda31d1d0/hosts",
        "LogPath": "/var/lib/docker/containers/09c189a1c6b5a2e2b317c52df4866a9b26144e220858646a5157d9fcda31d1d0/09c189a1c6b5a2e2b317c52df4866a9b26144e220858646a5157d9fcda31d1d0-json.log",
        "Name": "/myjprogress_php_1",
        "RestartCount": 0,
        "Driver": "overlay2",
        "Platform": "linux",
        "MountLabel": "",
        "ProcessLabel": "",
        "AppArmorProfile": "",
        "ExecIDs": null,
        "HostConfig": {
            "Binds": [
                "/Users/alimechichi/www/MyJProgress/var:/var/www/var:rw",
                "/Users/alimechichi/www/MyJProgress/vendor:/var/www/vendor:cached",
                "/Users/alimechichi/www/MyJProgress:/var/www:cached"
            ],
            "ContainerIDFile": "",
            "LogConfig": {
                "Type": "json-file",
                "Config": {}
            },
            "NetworkMode": "myjprogress_default",
            "PortBindings": {},
            "RestartPolicy": {
                "Name": "unless-stopped",
                "MaximumRetryCount": 0
            },
            "AutoRemove": false,
            "VolumeDriver": "",
            "VolumesFrom": [],
            "CapAdd": null,
            "CapDrop": null,
            "CgroupnsMode": "host",
            "Dns": null,
            "DnsOptions": null,
            "DnsSearch": null,
            "ExtraHosts": null,
            "GroupAdd": null,
            "IpcMode": "private",
            "Cgroup": "",
            "Links": null,
            "OomScoreAdj": 0,
            "PidMode": "",
            "Privileged": false,
            "PublishAllPorts": false,
            "ReadonlyRootfs": false,
            "SecurityOpt": null,
            "UTSMode": "",
            "UsernsMode": "",
            "ShmSize": 67108864,
            "Runtime": "runc",
            "ConsoleSize": [
                0,
                0
            ],
            "Isolation": "",
            "CpuShares": 0,
            "Memory": 0,
            "NanoCpus": 0,
            "CgroupParent": "",
            "BlkioWeight": 0,
            "BlkioWeightDevice": null,
            "BlkioDeviceReadBps": null,
            "BlkioDeviceWriteBps": null,
            "BlkioDeviceReadIOps": null,
            "BlkioDeviceWriteIOps": null,
            "CpuPeriod": 0,
            "CpuQuota": 0,
            "CpuRealtimePeriod": 0,
            "CpuRealtimeRuntime": 0,
            "CpusetCpus": "",
            "CpusetMems": "",
            "Devices": null,
            "DeviceCgroupRules": null,
            "DeviceRequests": null,
            "KernelMemory": 0,
            "KernelMemoryTCP": 0,
            "MemoryReservation": 0,
            "MemorySwap": 0,
            "MemorySwappiness": null,
            "OomKillDisable": false,
            "PidsLimit": null,
            "Ulimits": null,
            "CpuCount": 0,
            "CpuPercent": 0,
            "IOMaximumIOps": 0,
            "IOMaximumBandwidth": 0,
            "MaskedPaths": [
                "/proc/asound",
                "/proc/acpi",
                "/proc/kcore",
                "/proc/keys",
                "/proc/latency_stats",
                "/proc/timer_list",
                "/proc/timer_stats",
                "/proc/sched_debug",
                "/proc/scsi",
                "/sys/firmware"
            ],
            "ReadonlyPaths": [
                "/proc/bus",
                "/proc/fs",
                "/proc/irq",
                "/proc/sys",
                "/proc/sysrq-trigger"
            ]
        },
        "GraphDriver": {
            "Data": {
                "LowerDir": "/var/lib/docker/overlay2/349412f119194f3e2bcf2d3d2bd797db221f931fca676dd5c1b3a8eae746ffb8-init/diff:/var/lib/docker/overlay2/nnh2ypx89gbek1jo6sxgc6cr2/diff:/var/lib/docker/overlay2/pjivt4xjdujjhnb0xtgm0fx51/diff:/var/lib/docker/overlay2/voz95jwd5i55zirjjn8pca4am/diff:/var/lib/docker/overlay2/d86hhi0ld0hgwbmtzceejd4oy/diff:/var/lib/docker/overlay2/jecw9uaqdf1uxnj4uv4i97is0/diff:/var/lib/docker/overlay2/twmw2u6dr9w35tk83hzx52jmi/diff:/var/lib/docker/overlay2/ofivq2ldq0v3gp4nfjjfmcu9h/diff:/var/lib/docker/overlay2/vgp5nwyet2y19phxc7jgryqmw/diff:/var/lib/docker/overlay2/xh4qmvbwjt4eaoqxb323itn1t/diff:/var/lib/docker/overlay2/8d20035c0f92a76c8af33794c6cb4a95c79d2a5ecdb529811e39cf8f91667ca5/diff:/var/lib/docker/overlay2/51dd40f3e7e498db78e8b0d4efd2507dd4b862d1a46f93c79231e2c91a800b10/diff:/var/lib/docker/overlay2/818b6e9e54ec9c82149b57bd3c393a20ef91ee724e35c604d6fdb18a4f233db6/diff:/var/lib/docker/overlay2/07b7adb5b9ab5fd332fcb3a5c7da7f5143442d5062610530f0ad199da38dbc55/diff:/var/lib/docker/overlay2/289f7000eefc02b701dbf652644871d2f31f8da45310e43d853339e48ebd5aa4/diff:/var/lib/docker/overlay2/ad21dcaa934ae55a969533f43e631676f727bc003938463c80cb09b6f514b532/diff:/var/lib/docker/overlay2/0ba3a19aa29dc263275c38811cebce8b63e7a0902c02de1aa670e8cbdf29c723/diff:/var/lib/docker/overlay2/afdd8f8146a4a80905f468e7f6fe3384c92e8e190993c9bc1c6eb161d1e6a655/diff:/var/lib/docker/overlay2/90ad91b0eb78ed8c0f8f351098c4d0ff83ec0ef21c68ab85d5d8c21e57c935ec/diff:/var/lib/docker/overlay2/f1d19fdaa807174df69164beb141c62f080f576b83762203ff247ea319a65ec8/diff",
                "MergedDir": "/var/lib/docker/overlay2/349412f119194f3e2bcf2d3d2bd797db221f931fca676dd5c1b3a8eae746ffb8/merged",
                "UpperDir": "/var/lib/docker/overlay2/349412f119194f3e2bcf2d3d2bd797db221f931fca676dd5c1b3a8eae746ffb8/diff",
                "WorkDir": "/var/lib/docker/overlay2/349412f119194f3e2bcf2d3d2bd797db221f931fca676dd5c1b3a8eae746ffb8/work"
            },
            "Name": "overlay2"
        },
        "Mounts": [
            {
                "Type": "bind",
                "Source": "/Users/alimechichi/www/MyJProgress",
                "Destination": "/var/www",
                "Mode": "cached",
                "RW": true,
                "Propagation": "rprivate"
            },
            {
                "Type": "volume",
                "Name": "81a02cd4e2c1c9292ec23ace34a689398d5f3dc60f7f122fc0f3fd2ba8ea6d73",
                "Source": "/var/lib/docker/volumes/81a02cd4e2c1c9292ec23ace34a689398d5f3dc60f7f122fc0f3fd2ba8ea6d73/_data",
                "Destination": "/var/www/data",
                "Driver": "local",
                "Mode": "",
                "RW": true,
                "Propagation": ""
            },
            {
                "Type": "bind",
                "Source": "/Users/alimechichi/www/MyJProgress/var",
                "Destination": "/var/www/var",
                "Mode": "rw",
                "RW": true,
                "Propagation": "rprivate"
            },
            {
                "Type": "bind",
                "Source": "/Users/alimechichi/www/MyJProgress/vendor",
                "Destination": "/var/www/vendor",
                "Mode": "cached",
                "RW": true,
                "Propagation": "rprivate"
            }
        ],
        "Config": {
            "Hostname": "09c189a1c6b5",
            "Domainname": "",
            "User": "",
            "AttachStdin": false,
            "AttachStdout": false,
            "AttachStderr": false,
            "ExposedPorts": {
                "9000/tcp": {}
            },
            "Tty": false,
            "OpenStdin": false,
            "StdinOnce": false,
            "Env": [
                "PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin",
                "PHPIZE_DEPS=autoconf \t\tdpkg-dev dpkg \t\tfile \t\tg++ \t\tgcc \t\tlibc-dev \t\tmake \t\tpkgconf \t\tre2c",
                "PHP_INI_DIR=/usr/local/etc/php",
                "PHP_EXTRA_CONFIGURE_ARGS=--enable-fpm --with-fpm-user=www-data --with-fpm-group=www-data --disable-cgi",
                "PHP_CFLAGS=-fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64",
                "PHP_CPPFLAGS=-fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64",
                "PHP_LDFLAGS=-Wl,-O1 -pie",
                "GPG_KEYS=1729F83938DA44E27BA0F4D3DBDB397470D12172 BFDDD28642824F8118EF77909B67A5C12229118F",
                "PHP_VERSION=8.0.3",
                "PHP_URL=https://www.php.net/distributions/php-8.0.3.tar.xz",
                "PHP_ASC_URL=https://www.php.net/distributions/php-8.0.3.tar.xz.asc",
                "PHP_SHA256=c9816aa9745a9695672951eaff3a35ca5eddcb9cacf87a4f04b9fb1169010251"
            ],
            "Cmd": [
                "php-fpm",
                "-F"
            ],
            "Image": "myjprogress_php",
            "Volumes": {
                "/var/www": {},
                "/var/www/data": {},
                "/var/www/var": {},
                "/var/www/vendor": {}
            },
            "WorkingDir": "/var/www",
            "Entrypoint": [
                "docker-php-entrypoint"
            ],
            "OnBuild": null,
            "Labels": {
                "com.docker.compose.config-hash": "0cceceae573c62e6dccb0c89bcd9d6342bb7f516185d7c5bb9cd96ab47bf37e2",
                "com.docker.compose.container-number": "1",
                "com.docker.compose.oneoff": "False",
                "com.docker.compose.project": "myjprogress",
                "com.docker.compose.project.config_files": "docker-compose.yml",
                "com.docker.compose.project.working_dir": "/Users/alimechichi/www/MyJProgress",
                "com.docker.compose.service": "php",
                "com.docker.compose.version": "1.28.5"
            },
            "StopSignal": "SIGQUIT"
        },
        "NetworkSettings": {
            "Bridge": "",
            "SandboxID": "9984b47b62966a06cbf41939212a9ba6518c95c297688dc746601e167601b1d1",
            "HairpinMode": false,
            "LinkLocalIPv6Address": "",
            "LinkLocalIPv6PrefixLen": 0,
            "Ports": {
                "9000/tcp": null
            },
            "SandboxKey": "/var/run/docker/netns/9984b47b6296",
            "SecondaryIPAddresses": null,
            "SecondaryIPv6Addresses": null,
            "EndpointID": "",
            "Gateway": "",
            "GlobalIPv6Address": "",
            "GlobalIPv6PrefixLen": 0,
            "IPAddress": "",
            "IPPrefixLen": 0,
            "IPv6Gateway": "",
            "MacAddress": "",
            "Networks": {
                "myjprogress_default": {
                    "IPAMConfig": null,
                    "Links": null,
                    "Aliases": [
                        "php",
                        "09c189a1c6b5"
                    ],
                    "NetworkID": "2c30cca195335d0afc78a22b4e15ba63ed0accac9cd4e928fc7b64266fceb790",
                    "EndpointID": "1c1b394bf65d5cc434919ee4259e5edf7c2e6e97897185c8343d7a8cc7d8afaf",
                    "Gateway": "172.19.0.1",
                    "IPAddress": "172.19.0.7",
                    "IPPrefixLen": 16,
                    "IPv6Gateway": "",
                    "GlobalIPv6Address": "",
                    "GlobalIPv6PrefixLen": 0,
                    "MacAddress": "02:42:ac:13:00:07",
                    "DriverOpts": null
                }
            }
        }
    }
]
