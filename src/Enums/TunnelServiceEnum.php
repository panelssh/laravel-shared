<?php

namespace PanelSsh\Shared\Enums;

class TunnelServiceEnum
{
    const SSH_TUNNEL = 1;
    const OPENVPN = 2;
    const L2TP_IPSEC = 3;
    const WIREGUARD = 4;
    const SHADOWSOCKS = 5;
    const V2RAY_VMESS = 6;
    const TROJAN = 7;
}
