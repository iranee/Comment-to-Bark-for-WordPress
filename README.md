## Comment to Bark for WordPress
## WordPress Bark 推送评论通知
- 支持自定义推送铃声
-  支持自定义推送图标
-  支持自动跳转到评论页面
-  支持检测是否为作者ID
-  待审核/垃圾评论不推送

## 变量
```
$comment	    	评论结构
$post_name		被评论的文章
$bark_key		bark token
$bark_icon		bark 推送图标
$bark_group		bark 群组
$bark_goto_url		bark 文章链接
$bark_sound		bark 推送声音
$bark_archive		bark 保存信息	1-启用 0-停用 启用后客户端自动保存推送信息
$isMyself		检测作者ID      1-启用 0-停用 启用后当评论者为 $customName 时不通知 
$customName		作者评论ID      如果此值为空，则停用检测
 ```

## 获取Bark token
- 适合iPhone的客户端：[App Store 商店](https://itunes.apple.com/cn/app/bark-customed-notifications/id1403753865 "App Store 商店")
- 适合Android的客户端：[Chrome 商店](https://chrome.google.com/webstore/detail/bark/pmlkbdbpglkgbgopghdcmohdcmladeii "Chrome 商店")
- Bark[客户端](https://github.com/Finb/Bark "客户端")和[服务端](https://github.com/Finb/go-tools "服务端")均已开源，也可以自己部署
- 安装后打开bark App，将红线上方的token填入变量```$bark_key = ""```里面

![](https://cheen.cn/wp-content/uploads/2022/01/bark.jpg)

## 通知示意
![](https://cheen.cn/wp-content/cache/theme-thumbnail/972d5c32a9f2628acb4e93828cd3ce26-680-170.jpg)


## 如何使用
将Comment_to_Bark.php下载到主题目录，编辑functions.php，在最后一行加入
```
// Bark推送评论通知 
include('Comment_to_Bark.php');
```
