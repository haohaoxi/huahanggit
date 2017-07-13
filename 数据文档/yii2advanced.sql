/*
Navicat MySQL Data Transfer

Source Server         : 192.168.111.129_3306
Source Server Version : 50711
Source Host           : 192.168.111.129:3306
Source Database       : yii2advanced

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-06-06 17:33:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL COMMENT '名称',
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `password_reset_token` varchar(256) DEFAULT NULL,
  `email` varchar(256) NOT NULL COMMENT '邮箱',
  `role` smallint(8) NOT NULL COMMENT '角色等级',
  `status` tinyint(2) NOT NULL DEFAULT '10' COMMENT '状态（10：正常2：关闭）',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'JHzbWjU-npmyxozZQXOY-hxXce-piaYA', '$2y$13$3f/fYCbrD/PuSS3FBO68weO.7vi0a6sjdKURLLmGlf7ZQKH5GIBzG', null, 'webherobo@qq.com', '0', '10', '1495853207', '1495853207');
INSERT INTO `admin` VALUES ('2', 'admin1', 'ugsGQ-Rl7coMQ9Xl7fhUefAsz7IZyF_1', '$2y$13$7oiaWRCOtft76XEtwd5yW..RWX1DMMlOVHrbsdP4jpabQhFL4axnO', null, 'webherobo@qq.com', '0', '10', '1495853543', '1495853543');
INSERT INTO `admin` VALUES ('3', 'admin3', 'Km8GZWLl-wJkoO03wwhOWIjJMEnWdfbm', '$2y$13$CsOovEBgbMfayVG2GKXntuGx0ebKugBhcL1Kvu9u/ky1X2B6aPYI2', null, 'webherobo@qq.com', '0', '10', '1495854541', '1495854541');
INSERT INTO `admin` VALUES ('4', 'admin2', 'JauRuCVOAdBmz-oyR84psqmemqs8cpXp', '$2y$13$jf/3Db0LT/fFjW6BUATGIuda0sXdtI0ODVCwH/DveK2jCCMHHzDgS', null, 'admin', '0', '10', '1495855804', '1495855804');
INSERT INTO `admin` VALUES ('5', 'admin5', '5yMdoPQwL81NIsBAlAyyHfzNd5L9rJjk', '$2y$13$Uh4QS48/VgtX.x7dQmiIo.0kr2IhGUMuCI3HBTWa7VGfWzbtUB5d6', null, 'webherobo@qq.com', '0', '10', '1495856007', '1495856007');
INSERT INTO `admin` VALUES ('6', 'admin6', 'INtZg3Uw4Lhv5xxj21S1BNntNhldthrB', '$2y$13$IwrliOX9byDaLJLDqU3YRuWKrc/9R9DvygOyeqIQntgtJt0Vf4s2y', null, 'webherobo@qq.com', '0', '10', '1495856384', '1495856384');
INSERT INTO `admin` VALUES ('7', 'admin7', 'NAO2a2ucLH41zAE7c-KISs0UUr4ubOo3', '$2y$13$vVc4OvXaJCEoLJqw9nonjOkO0tjlDOrBtJMsMgCyiinlSNvocBwgy', null, 'webherobo@qq.com', '0', '10', '1495856439', '1495856439');
INSERT INTO `admin` VALUES ('8', 'admin8', '56hJQwAT6C7t78w8LcutjOuHBVq0kgHJ', '$2y$13$r6rd6of55nP.ObnN92v21.utW0wnVXEkg6z/98HvAAFQSJavUnvmy', null, 'webherobo@qq.com', '0', '10', '1495856592', '1495856592');
INSERT INTO `admin` VALUES ('9', '131231231', 'cVcFV5hVYlFr1MZAx5uHB-cFv5Sh1uV1', '$2y$13$Fw5nGRgIy2bNv.xYLjRKouy3uHW7woOhE8h5yHGwoQIrEKeHEh2b.', null, 'admin', '0', '10', '1495856765', '1495856765');
INSERT INTO `admin` VALUES ('10', 'admin9', 'AYoOV-8MmLQPlpy3WIECv_nvOSo01ClM', '$2y$13$LCqwvW2lqKJDcc.XBgONqumo6CFEIyXawsunRgvLC3ZhXVa6epMQy', null, 'webherobo@qq.com', '0', '10', '1495857003', '1495857003');

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('超级管理员', '1', '1496204075');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '全局唯一的性的名称',
  `type` smallint(6) NOT NULL COMMENT '1:角色 2：权限',
  `description` text COLLATE utf8_unicode_ci COMMENT '项目描述',
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '规则的名称',
  `data` blob COMMENT '附加数据',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/*', '2', null, null, null, '1487816675', '1487816675');
INSERT INTO `auth_item` VALUES ('/admin/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/activate', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/login', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/logout', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/password', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/request-password-reset', '2', null, null, null, '1496217082', '1496217082');
INSERT INTO `auth_item` VALUES ('/admin/reset-password', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/signup', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/assignment/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/assignment/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/assignment/index', '2', null, null, null, '1496224414', '1496224414');
INSERT INTO `auth_item` VALUES ('/assignment/revoke', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/assignment/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/batch/*', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `auth_item` VALUES ('/batch/cruds', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `auth_item` VALUES ('/batch/index', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `auth_item` VALUES ('/batch/models', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `auth_item` VALUES ('/debug/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/db-explain', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/download-mail', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/toolbar', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/action', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/diff', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/preview', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/menu/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/menu/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/menu/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/menu/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/menu/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/menu/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/mytest/index', '2', null, null, null, '1496283417', '1496283417');
INSERT INTO `auth_item` VALUES ('/mytest2/index', '2', null, null, null, '1496283476', '1496283476');
INSERT INTO `auth_item` VALUES ('/permission/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/permission/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/permission/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/permission/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/permission/index', '2', null, null, null, '1496282715', '1496282715');
INSERT INTO `auth_item` VALUES ('/permission/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/permission/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/permission/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/role/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/role/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/role/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/role/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/role/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/role/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/role/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/role/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/route/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/route/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/route/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/route/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/route/refresh', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/route/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/rule/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/rule/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/rule/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/rule/index', '2', null, null, null, '1496194686', '1496194686');
INSERT INTO `auth_item` VALUES ('/rule/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/rule/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/error', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/login', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/logout', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('guest', '1', '默认角色', null, null, '1496307418', '1496307541');
INSERT INTO `auth_item` VALUES ('membershipAuthority', '2', '会员基础权限', null, null, '1496307488', '1496307526');
INSERT INTO `auth_item` VALUES ('管理员', '2', null, 'adminrule', null, '1495961918', '1496280005');
INSERT INTO `auth_item` VALUES ('超级管理员', '1', null, 'adminrule', null, '1487817275', '1496217181');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('管理员', '/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/activate');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/login');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/logout');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/password');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/request-password-reset');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/reset-password');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/signup');
INSERT INTO `auth_item_child` VALUES ('管理员', '/admin/view');
INSERT INTO `auth_item_child` VALUES ('管理员', '/assignment/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/assignment/assign');
INSERT INTO `auth_item_child` VALUES ('管理员', '/assignment/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/assignment/revoke');
INSERT INTO `auth_item_child` VALUES ('管理员', '/assignment/view');
INSERT INTO `auth_item_child` VALUES ('管理员', '/batch/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/batch/cruds');
INSERT INTO `auth_item_child` VALUES ('管理员', '/batch/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/batch/models');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/debug/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/debug/*');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/debug/default/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/debug/default/*');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/debug/default/db-explain');
INSERT INTO `auth_item_child` VALUES ('管理员', '/debug/default/db-explain');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/debug/default/download-mail');
INSERT INTO `auth_item_child` VALUES ('管理员', '/debug/default/download-mail');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/debug/default/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/debug/default/index');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/debug/default/toolbar');
INSERT INTO `auth_item_child` VALUES ('管理员', '/debug/default/toolbar');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/debug/default/view');
INSERT INTO `auth_item_child` VALUES ('管理员', '/debug/default/view');
INSERT INTO `auth_item_child` VALUES ('管理员', '/default/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/default/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/gii/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/gii/default/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/gii/default/action');
INSERT INTO `auth_item_child` VALUES ('管理员', '/gii/default/diff');
INSERT INTO `auth_item_child` VALUES ('管理员', '/gii/default/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/gii/default/preview');
INSERT INTO `auth_item_child` VALUES ('管理员', '/gii/default/view');
INSERT INTO `auth_item_child` VALUES ('管理员', '/menu/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/menu/create');
INSERT INTO `auth_item_child` VALUES ('管理员', '/menu/delete');
INSERT INTO `auth_item_child` VALUES ('管理员', '/menu/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/menu/update');
INSERT INTO `auth_item_child` VALUES ('管理员', '/menu/view');
INSERT INTO `auth_item_child` VALUES ('管理员', '/permission/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/permission/assign');
INSERT INTO `auth_item_child` VALUES ('管理员', '/permission/create');
INSERT INTO `auth_item_child` VALUES ('管理员', '/permission/delete');
INSERT INTO `auth_item_child` VALUES ('管理员', '/permission/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/permission/remove');
INSERT INTO `auth_item_child` VALUES ('管理员', '/permission/update');
INSERT INTO `auth_item_child` VALUES ('管理员', '/permission/view');
INSERT INTO `auth_item_child` VALUES ('管理员', '/role/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/role/assign');
INSERT INTO `auth_item_child` VALUES ('管理员', '/role/create');
INSERT INTO `auth_item_child` VALUES ('管理员', '/role/delete');
INSERT INTO `auth_item_child` VALUES ('管理员', '/role/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/role/remove');
INSERT INTO `auth_item_child` VALUES ('管理员', '/role/update');
INSERT INTO `auth_item_child` VALUES ('管理员', '/role/view');
INSERT INTO `auth_item_child` VALUES ('管理员', '/route/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/route/assign');
INSERT INTO `auth_item_child` VALUES ('管理员', '/route/create');
INSERT INTO `auth_item_child` VALUES ('管理员', '/route/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/route/refresh');
INSERT INTO `auth_item_child` VALUES ('管理员', '/route/remove');
INSERT INTO `auth_item_child` VALUES ('管理员', '/rule/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/rule/create');
INSERT INTO `auth_item_child` VALUES ('管理员', '/rule/delete');
INSERT INTO `auth_item_child` VALUES ('管理员', '/rule/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/rule/update');
INSERT INTO `auth_item_child` VALUES ('管理员', '/rule/view');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/site/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/site/*');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/site/error');
INSERT INTO `auth_item_child` VALUES ('管理员', '/site/error');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/site/index');
INSERT INTO `auth_item_child` VALUES ('管理员', '/site/index');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/site/login');
INSERT INTO `auth_item_child` VALUES ('管理员', '/site/login');
INSERT INTO `auth_item_child` VALUES ('membershipAuthority', '/site/logout');
INSERT INTO `auth_item_child` VALUES ('管理员', '/site/logout');
INSERT INTO `auth_item_child` VALUES ('guest', 'membershipAuthority');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '管理员');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '规则名称',
  `data` blob COMMENT '规则类名(eg:backend\\components\\RouteRule)',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('adminrule', 0x4F3A32383A226261636B656E645C636F6D706F6E656E74735C526F75746552756C65223A333A7B733A343A226E616D65223B733A393A2261646D696E72756C65223B733A393A22637265617465644174223B693A313439353936313930313B733A393A22757064617465644174223B693A313439353936313930313B7D, '1495961901', '1495961901');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT '分类id',
  `pid` int(11) DEFAULT NULL COMMENT '父id',
  `category_name` varchar(128) CHARACTER SET utf8 DEFAULT NULL COMMENT '分类名称',
  `category_describe` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '分类描述',
  `sort
s` int(11) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（1：正常2：关闭）',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of category
-- ----------------------------

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(68) NOT NULL COMMENT '会员账号',
  `name` varchar(128) NOT NULL COMMENT '会员名称',
  `passwd` varchar(64) NOT NULL COMMENT '初始密码',
  `level_id` int(11) DEFAULT NULL COMMENT '会员等级id',
  `telnum` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码时的口令',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（1：正常2：关闭）',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------

-- ----------------------------
-- Table structure for member_info
-- ----------------------------
DROP TABLE IF EXISTS `member_info`;
CREATE TABLE `member_info` (
  `member_id` int(11) unsigned NOT NULL COMMENT '关联会员id',
  `id_card` varchar(20) DEFAULT '0' COMMENT '身份证号码',
  `address_details` varchar(255) DEFAULT NULL COMMENT '用户详细地址',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` varchar(255) DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member_info
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '系统设置', null, null, '100', 0x66612066612D7772656E6368);
INSERT INTO `menu` VALUES ('2', '菜单列表', '1', '/menu', '1', 0x66612066612D62617273);
INSERT INTO `menu` VALUES ('3', '角色列表', '1', '/role', '2', 0x66612066612D7573657273);
INSERT INTO `menu` VALUES ('4', '用户管理', '1', '/admin', '3', 0x66612066612D75736572);
INSERT INTO `menu` VALUES ('5', '权限列表', '1', '/permission', '6', 0x7B2269636F6E223A20226C6F636B222C202276697369626C65223A20747275652C226D756C74692D636F6E74726F6C6C6572223A5B2272756C65222C2022726F757465225D7D);
INSERT INTO `menu` VALUES ('6', '路由列表', '1', '/route', '4', 0x66612066612D696E7465726E65742D6578706C6F726572);
INSERT INTO `menu` VALUES ('7', '规则列表', '1', '/rule', '5', 0x7B2269636F6E223A20226C697374222C202276697369626C65223A20747275652C226D756C74692D636F6E74726F6C6C6572223A5B2272756C65222C2022726F757465225D7D);
INSERT INTO `menu` VALUES ('8', '分配权限', '1', '/assignment', '7', 0x66612066612D756E6C6F636B);

-- ----------------------------
-- Table structure for merchant_info
-- ----------------------------
DROP TABLE IF EXISTS `merchant_info`;
CREATE TABLE `merchant_info` (
  `id` int(11) unsigned NOT NULL,
  `merchant_name` varchar(255) NOT NULL COMMENT '名称',
  `merchant_address_details` varchar(255) NOT NULL COMMENT '地址详情',
  `member_id` int(11) DEFAULT NULL COMMENT '会员id',
  `industry_type` varchar(128) DEFAULT NULL COMMENT '行业类型',
  `merchant_info_details` text COMMENT '详细信息',
  `principal
_name` varchar(100) DEFAULT NULL COMMENT '负责人姓名',
  `principal
_idcard_img` varchar(255) DEFAULT NULL COMMENT '负责人身份证正面',
  `principal
_idcard_img2` varchar(255) DEFAULT NULL COMMENT '负责人身份证反面',
  `business_license_num` varchar(32) DEFAULT NULL COMMENT '营业执照注册号',
  `business_license_img` varchar(255) DEFAULT NULL COMMENT '营业执照注册图片',
  `group
_id` int(11) unsigned DEFAULT NULL COMMENT '分组级别id',
  `status` tinyint(1) DEFAULT '1' COMMENT '账户状态(1:正常 2：关闭)默认1',
  `audit_state` tinyint(1) DEFAULT '1' COMMENT '审核状态(1 审核中 2未通过 3通过 4 待完善) ',
  `audit_time` int(11) DEFAULT NULL COMMENT '审核时间',
  `rejected_time` int(11) DEFAULT NULL COMMENT '驳回时间',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of merchant_info
-- ----------------------------

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1495768354');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1495768687');
INSERT INTO `migration` VALUES ('m140602_111327_create_menu_table', '1495771448');
INSERT INTO `migration` VALUES ('m160312_050000_create_admin', '1495771570');
INSERT INTO `migration` VALUES ('m160312_050000_create_user', '1495771448');
INSERT INTO `migration` VALUES ('m160312_050001_create_admin', '1495771820');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'aD1lCS9TT9dgqXZov9_Trgow2iMHJrKe', '$2y$13$B6afE8nLUbqam.IL8yr.LeR2FJbQfF83jXep1u8ZqWveVVa4zNXbi', 'RB645pVdcBHljp55SzfI20ZgkAZmsrg__1496735045', 'admin@qq.com', '10', '1496646396', '1496735045');
