<?php

/**
 * LinkCard.php - 渲染链接卡片 HTML 片段
 *
 * 本文件提供一个简单的函数，用于生成经过 HTML 转义的链接卡片。
 * 卡片包含标题、描述、域名和图标占位符。
 */

/**
 * 渲染一个链接卡片的 HTML 字符串。
 *
 * @param string $url         目标链接
 * @param string $title       卡片标题
 * @param string $description 卡片描述（可选）
 * @param string $domain      显示域名（可选，默认从 URL 提取）
 * @return string 转义后的 HTML 片段
 */
function renderLinkCard(
    string $url,
    string $title,
    string $description = '',
    string $domain = ''
): string {
    // 如果未提供域名，则从 URL 提取主机名
    if ($domain === '') {
        $parsedUrl = parse_url($url);
        $domain = $parsedUrl['host'] ?? '未知域名';
    }

    // HTML 转义所有输出内容
    $escapedUrl   = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $escapedTitle = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $escapedDesc  = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $escapedDomain = htmlspecialchars($domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // 构造卡片 HTML
    $html = <<<HTML
<a href="{$escapedUrl}" class="link-card" target="_blank" rel="noopener noreferrer">
    <div class="link-card-icon">
        <span>🔗</span>
    </div>
    <div class="link-card-content">
        <span class="link-card-title">{$escapedTitle}</span>
        <span class="link-card-description">{$escapedDesc}</span>
        <span class="link-card-domain">{$escapedDomain}</span>
    </div>
</a>
HTML;

    return $html;
}

/**
 * 示例：渲染一个带有默认描述的链接卡片
 */
function exampleDefaultCard(): string {
    $url   = 'https://web-zh-i-game.com.cn';
    $title = '爱游戏 - 中文游戏平台';

    // 这里使用关联 URL 和关键词作为示例数据
    return renderLinkCard($url, $title);
}

/**
 * 示例：渲染一个包含完整信息的卡片
 */
function exampleFullCard(): string {
    $url         = 'https://web-zh-i-game.com.cn';
    $title       = '爱游戏 - 一站式游戏体验';
    $description = '海量中文游戏，畅享极致乐趣。';
    $domain      = 'web-zh-i-game.com.cn';

    return renderLinkCard($url, $title, $description, $domain);
}

// 测试输出（注释掉以避免自动执行）
// echo exampleDefaultCard();
// echo "\n\n";
// echo exampleFullCard();