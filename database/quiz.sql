/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : quiz

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2016-02-05 08:39:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for core_address
-- ----------------------------
DROP TABLE IF EXISTS `core_address`;
CREATE TABLE `core_address` (
  `address_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_line` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_line2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_postal_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address_district` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `address_province` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `address_country` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=314 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_address
-- ----------------------------
INSERT INTO `core_address` VALUES ('1', '', 'Cự Lộc - Thanh Hóa', 'Từ Liêm - Hà Nội', '', 'Từ Liêm', 'Hà Nội', '');
INSERT INTO `core_address` VALUES ('2', '', 'Cự Lộc - Thanh Hóa', 'Từ Liêm - Hà Nội', '', 'Từ Liêm', 'Hà Nội', '');
INSERT INTO `core_address` VALUES ('3', '', 'Yên Lạc - Vĩnh Phúc', 'Thanh Xuân - Hà Nội', '', 'Thanh Xuân', 'Hà Nội', '');
INSERT INTO `core_address` VALUES ('4', '', 'Phúc Yên - Vĩnh Phúc', 'Từ Liêm - Hà Nội', '', 'Từ Liêm', 'Hà Nội', '');
INSERT INTO `core_address` VALUES ('5', '', 'Cự Lộc - Thanh Hóa', 'Từ Liêm - Hà Nội', '', 'Từ Liêm', 'Hà Nội', '');
INSERT INTO `core_address` VALUES ('6', '', 'Yên Lạc - Vĩnh Phúc', 'Thanh Xuân - Hà Nội', '', 'Thanh Xuân', 'Hà Nội', '');
INSERT INTO `core_address` VALUES ('8', '', 'Yên Lạc - Vĩnh Phúc', 'Thanh Xuân - Hà Nội', '', 'Thanh Xuân', 'Hà Nội', '');
INSERT INTO `core_address` VALUES ('9', '', 'Yên Lạc - Vĩnh Phúc', 'Thanh Xuân - Hà Nội', '', 'Thanh Xuân', 'Hà Nội', 'VNM');
INSERT INTO `core_address` VALUES ('10', '', 'Xuan Hoa', 'Ha Noi', '', '', '', 'VNM');
INSERT INTO `core_address` VALUES ('11', '', 'Vinh Phuc', 'Ha Noi', '', '', '', 'VNM');
INSERT INTO `core_address` VALUES ('12', '', 'HN', '', '', '', '', 'VNM');
INSERT INTO `core_address` VALUES ('13', '', 'HN', '', '', '', '', 'VNM');
INSERT INTO `core_address` VALUES ('14', '', 'HN', '', '', '', '', 'VNM');
INSERT INTO `core_address` VALUES ('15', null, null, null, '', 'SHuyen A1', 'STinh B1', 'VNM');
INSERT INTO `core_address` VALUES ('16', null, null, null, '', 'SHuyen A2', 'STinh B2', 'VNM');
INSERT INTO `core_address` VALUES ('17', null, null, null, '', 'SHuyen A3', 'STinh B3', 'VNM');
INSERT INTO `core_address` VALUES ('18', null, null, null, '', 'SHuyen A4', 'STinh B4', 'VNM');
INSERT INTO `core_address` VALUES ('19', null, null, null, '', 'Huyen A5', 'Tinh B5', 'VNM');
INSERT INTO `core_address` VALUES ('20', null, null, null, '', 'SHuyen A6', 'STinh B6', 'VNM');
INSERT INTO `core_address` VALUES ('21', null, null, null, '', 'Huyen A6', 'Tinh B6', 'VNM');
INSERT INTO `core_address` VALUES ('22', null, null, null, '', 'SHuyen A7', 'STinh B7', 'VNM');
INSERT INTO `core_address` VALUES ('23', null, null, null, '', 'Huyen A7', 'Tinh B7', 'VNM');
INSERT INTO `core_address` VALUES ('24', null, null, null, '', 'SHuyen A8', 'STinh B8', 'VNM');
INSERT INTO `core_address` VALUES ('25', null, null, null, '', 'Huyen A8', 'Tinh B8', 'VNM');
INSERT INTO `core_address` VALUES ('26', null, null, null, '', 'SHuyen A9', 'STinh B9', 'VNM');
INSERT INTO `core_address` VALUES ('27', null, null, null, '', 'Huyen A9', 'Tinh B9', 'VNM');
INSERT INTO `core_address` VALUES ('28', null, null, null, '', 'SHuyen A10', 'STinh B10', 'VNM');
INSERT INTO `core_address` VALUES ('29', null, null, null, '', 'Huyen A10', 'Tinh B10', 'VNM');
INSERT INTO `core_address` VALUES ('30', null, null, null, '', 'SHuyen A11', 'STinh B11', 'VNM');
INSERT INTO `core_address` VALUES ('31', null, null, null, '', 'Huyen A11', 'Tinh B11', 'VNM');
INSERT INTO `core_address` VALUES ('32', null, null, null, '', 'SHuyen A12', 'STinh B12', 'VNM');
INSERT INTO `core_address` VALUES ('33', null, null, null, '', 'Huyen A12', 'Tinh B12', 'VNM');
INSERT INTO `core_address` VALUES ('34', null, null, null, '', 'SHuyen A13', 'STinh B13', 'VNM');
INSERT INTO `core_address` VALUES ('35', null, null, null, '', 'Huyen A13', 'Tinh B13', 'VNM');
INSERT INTO `core_address` VALUES ('36', null, null, null, '', 'SHuyen A14', 'STinh B14', 'VNM');
INSERT INTO `core_address` VALUES ('37', null, null, null, '', 'Huyen A14', 'Tinh B14', 'VNM');
INSERT INTO `core_address` VALUES ('38', null, null, null, '', 'SHuyen A15', 'STinh B15', 'VNM');
INSERT INTO `core_address` VALUES ('39', null, null, null, '', 'Huyen A15', 'Tinh B15', 'VNM');
INSERT INTO `core_address` VALUES ('40', null, null, null, '', 'SHuyen A16', 'STinh B16', 'VNM');
INSERT INTO `core_address` VALUES ('41', null, null, null, '', 'Huyen A16', 'Tinh B16', 'VNM');
INSERT INTO `core_address` VALUES ('42', null, null, null, '', 'SHuyen A17', 'STinh B17', 'VNM');
INSERT INTO `core_address` VALUES ('43', null, null, null, '', 'Huyen A17', 'Tinh B17', 'VNM');
INSERT INTO `core_address` VALUES ('44', null, null, null, '', 'SHuyen A18', 'STinh B18', 'VNM');
INSERT INTO `core_address` VALUES ('45', null, null, null, '', 'Huyen A18', 'Tinh B18', 'VNM');
INSERT INTO `core_address` VALUES ('46', null, null, null, '', 'SHuyen A19', 'STinh B19', 'VNM');
INSERT INTO `core_address` VALUES ('47', null, null, null, '', 'Huyen A19', 'Tinh B19', 'VNM');
INSERT INTO `core_address` VALUES ('48', null, null, null, '', 'SHuyen A20', 'STinh B20', 'VNM');
INSERT INTO `core_address` VALUES ('49', null, null, null, '', 'Huyen A20', 'Tinh B20', 'VNM');
INSERT INTO `core_address` VALUES ('50', null, null, null, '', 'SHuyen A21', 'STinh B21', 'VNM');
INSERT INTO `core_address` VALUES ('51', null, null, null, '', 'Huyen A21', 'Tinh B21', 'VNM');
INSERT INTO `core_address` VALUES ('52', null, null, null, '', 'SHuyen A22', 'STinh B22', 'VNM');
INSERT INTO `core_address` VALUES ('53', null, null, null, '', 'Huyen A22', 'Tinh B22', 'VNM');
INSERT INTO `core_address` VALUES ('54', null, null, null, '', 'SHuyen A23', 'STinh B23', 'VNM');
INSERT INTO `core_address` VALUES ('55', null, null, null, '', 'Huyen A23', 'Tinh B23', 'VNM');
INSERT INTO `core_address` VALUES ('56', null, null, null, '', 'SHuyen A24', 'STinh B24', 'VNM');
INSERT INTO `core_address` VALUES ('57', null, null, null, '', 'Huyen A24', 'Tinh B24', 'VNM');
INSERT INTO `core_address` VALUES ('58', null, null, null, '', 'SHuyen A25', 'STinh B25', 'VNM');
INSERT INTO `core_address` VALUES ('59', null, null, null, '', 'Huyen A25', 'Tinh B25', 'VNM');
INSERT INTO `core_address` VALUES ('60', null, null, null, '', 'SHuyen A26', 'STinh B26', 'VNM');
INSERT INTO `core_address` VALUES ('61', null, null, null, '', 'Huyen A26', 'Tinh B26', 'VNM');
INSERT INTO `core_address` VALUES ('62', null, null, null, '', 'SHuyen A27', 'STinh B27', 'VNM');
INSERT INTO `core_address` VALUES ('63', null, null, null, '', 'Huyen A27', 'Tinh B27', 'VNM');
INSERT INTO `core_address` VALUES ('64', null, null, null, '', 'SHuyen A28', 'STinh B28', 'VNM');
INSERT INTO `core_address` VALUES ('65', null, null, null, '', 'Huyen A28', 'Tinh B28', 'VNM');
INSERT INTO `core_address` VALUES ('66', null, null, null, '', 'SHuyen A29', 'STinh B29', 'VNM');
INSERT INTO `core_address` VALUES ('67', null, null, null, '', 'Huyen A29', 'Tinh B29', 'VNM');
INSERT INTO `core_address` VALUES ('68', null, null, null, '', 'SHuyen A30', 'STinh B30', 'VNM');
INSERT INTO `core_address` VALUES ('69', null, null, null, '', 'Huyen A30', 'Tinh B30', 'VNM');
INSERT INTO `core_address` VALUES ('70', null, null, null, '', 'SHuyen A31', 'STinh B31', 'VNM');
INSERT INTO `core_address` VALUES ('71', null, null, null, '', 'Huyen A31', 'Tinh B31', 'VNM');
INSERT INTO `core_address` VALUES ('72', null, null, null, '', 'SHuyen A32', 'STinh B32', 'VNM');
INSERT INTO `core_address` VALUES ('73', null, null, null, '', 'Huyen A32', 'Tinh B32', 'VNM');
INSERT INTO `core_address` VALUES ('74', null, null, null, '', 'SHuyen A33', 'STinh B33', 'VNM');
INSERT INTO `core_address` VALUES ('75', null, null, null, '', 'Huyen A33', 'Tinh B33', 'VNM');
INSERT INTO `core_address` VALUES ('76', null, null, null, '', 'SHuyen A34', 'STinh B34', 'VNM');
INSERT INTO `core_address` VALUES ('77', null, null, null, '', 'Huyen A34', 'Tinh B34', 'VNM');
INSERT INTO `core_address` VALUES ('78', null, null, null, '', 'SHuyen A35', 'STinh B35', 'VNM');
INSERT INTO `core_address` VALUES ('79', null, null, null, '', 'Huyen A35', 'Tinh B35', 'VNM');
INSERT INTO `core_address` VALUES ('80', null, null, null, '', 'SHuyen A36', 'STinh B36', 'VNM');
INSERT INTO `core_address` VALUES ('81', null, null, null, '', 'Huyen A36', 'Tinh B36', 'VNM');
INSERT INTO `core_address` VALUES ('82', null, null, null, '', 'SHuyen A37', 'STinh B37', 'VNM');
INSERT INTO `core_address` VALUES ('83', null, null, null, '', 'Huyen A37', 'Tinh B37', 'VNM');
INSERT INTO `core_address` VALUES ('84', null, null, null, '', 'SHuyen A38', 'STinh B38', 'VNM');
INSERT INTO `core_address` VALUES ('85', null, null, null, '', 'Huyen A38', 'Tinh B38', 'VNM');
INSERT INTO `core_address` VALUES ('86', null, null, null, '', 'SHuyen A39', 'STinh B39', 'VNM');
INSERT INTO `core_address` VALUES ('87', null, null, null, '', 'Huyen A39', 'Tinh B39', 'VNM');
INSERT INTO `core_address` VALUES ('88', null, null, null, '', 'SHuyen A40', 'STinh B40', 'VNM');
INSERT INTO `core_address` VALUES ('89', null, null, null, '', 'Huyen A40', 'Tinh B40', 'VNM');
INSERT INTO `core_address` VALUES ('90', null, null, null, '', 'SHuyen A41', 'STinh B41', 'VNM');
INSERT INTO `core_address` VALUES ('91', null, null, null, '', 'Huyen A41', 'Tinh B41', 'VNM');
INSERT INTO `core_address` VALUES ('92', null, null, null, '', 'SHuyen A42', 'STinh B42', 'VNM');
INSERT INTO `core_address` VALUES ('93', null, null, null, '', 'Huyen A42', 'Tinh B42', 'VNM');
INSERT INTO `core_address` VALUES ('94', null, null, null, '', 'SHuyen A43', 'STinh B43', 'VNM');
INSERT INTO `core_address` VALUES ('95', null, null, null, '', 'Huyen A43', 'Tinh B43', 'VNM');
INSERT INTO `core_address` VALUES ('96', null, null, null, '', 'SHuyen A44', 'STinh B44', 'VNM');
INSERT INTO `core_address` VALUES ('97', null, null, null, '', 'Huyen A44', 'Tinh B44', 'VNM');
INSERT INTO `core_address` VALUES ('98', null, null, null, '', 'SHuyen A45', 'STinh B45', 'VNM');
INSERT INTO `core_address` VALUES ('99', null, null, null, '', 'Huyen A45', 'Tinh B45', 'VNM');
INSERT INTO `core_address` VALUES ('100', null, null, null, '', 'SHuyen A46', 'STinh B46', 'VNM');
INSERT INTO `core_address` VALUES ('101', null, null, null, '', 'Huyen A46', 'Tinh B46', 'VNM');
INSERT INTO `core_address` VALUES ('102', null, null, null, '', 'SHuyen A47', 'STinh B47', 'VNM');
INSERT INTO `core_address` VALUES ('103', null, null, null, '', 'Huyen A47', 'Tinh B47', 'VNM');
INSERT INTO `core_address` VALUES ('104', null, null, null, '', 'SHuyen A48', 'STinh B48', 'VNM');
INSERT INTO `core_address` VALUES ('105', null, null, null, '', 'Huyen A48', 'Tinh B48', 'VNM');
INSERT INTO `core_address` VALUES ('106', null, null, null, '', 'SHuyen A49', 'STinh B49', 'VNM');
INSERT INTO `core_address` VALUES ('107', null, null, null, '', 'Huyen A49', 'Tinh B49', 'VNM');
INSERT INTO `core_address` VALUES ('108', null, null, null, '', 'SHuyen A50', 'STinh B50', 'VNM');
INSERT INTO `core_address` VALUES ('109', null, null, null, '', 'Huyen A50', 'Tinh B50', 'VNM');
INSERT INTO `core_address` VALUES ('110', null, null, null, '', 'SHuyen A51', 'STinh B51', 'VNM');
INSERT INTO `core_address` VALUES ('111', null, null, null, '', 'Huyen A51', 'Tinh B51', 'VNM');
INSERT INTO `core_address` VALUES ('112', null, null, null, '', 'SHuyen A52', 'STinh B52', 'VNM');
INSERT INTO `core_address` VALUES ('113', null, null, null, '', 'Huyen A52', 'Tinh B52', 'VNM');
INSERT INTO `core_address` VALUES ('114', null, null, null, '', 'SHuyen A53', 'STinh B53', 'VNM');
INSERT INTO `core_address` VALUES ('115', null, null, null, '', 'Huyen A53', 'Tinh B53', 'VNM');
INSERT INTO `core_address` VALUES ('116', null, null, null, '', 'SHuyen A54', 'STinh B54', 'VNM');
INSERT INTO `core_address` VALUES ('117', null, null, null, '', 'Huyen A54', 'Tinh B54', 'VNM');
INSERT INTO `core_address` VALUES ('118', null, null, null, '', 'SHuyen A55', 'STinh B55', 'VNM');
INSERT INTO `core_address` VALUES ('119', null, null, null, '', 'Huyen A55', 'Tinh B55', 'VNM');
INSERT INTO `core_address` VALUES ('120', null, null, null, '', 'SHuyen A56', 'STinh B56', 'VNM');
INSERT INTO `core_address` VALUES ('121', null, null, null, '', 'Huyen A56', 'Tinh B56', 'VNM');
INSERT INTO `core_address` VALUES ('122', null, null, null, '', 'SHuyen A57', 'STinh B57', 'VNM');
INSERT INTO `core_address` VALUES ('123', null, null, null, '', 'Huyen A57', 'Tinh B57', 'VNM');
INSERT INTO `core_address` VALUES ('124', null, null, null, '', 'SHuyen A58', 'STinh B58', 'VNM');
INSERT INTO `core_address` VALUES ('125', null, null, null, '', 'Huyen A58', 'Tinh B58', 'VNM');
INSERT INTO `core_address` VALUES ('126', null, null, null, '', 'SHuyen A59', 'STinh B59', 'VNM');
INSERT INTO `core_address` VALUES ('127', null, null, null, '', 'Huyen A59', 'Tinh B59', 'VNM');
INSERT INTO `core_address` VALUES ('128', null, null, null, '', 'SHuyen A60', 'STinh B60', 'VNM');
INSERT INTO `core_address` VALUES ('129', null, null, null, '', 'Huyen A60', 'Tinh B60', 'VNM');
INSERT INTO `core_address` VALUES ('130', null, null, null, '', 'SHuyen A61', 'STinh B61', 'VNM');
INSERT INTO `core_address` VALUES ('131', null, null, null, '', 'Huyen A61', 'Tinh B61', 'VNM');
INSERT INTO `core_address` VALUES ('132', null, null, null, '', 'SHuyen A62', 'STinh B62', 'VNM');
INSERT INTO `core_address` VALUES ('133', null, null, null, '', 'Huyen A62', 'Tinh B62', 'VNM');
INSERT INTO `core_address` VALUES ('134', null, null, null, '', 'SHuyen A63', 'STinh B63', 'VNM');
INSERT INTO `core_address` VALUES ('135', null, null, null, '', 'Huyen A63', 'Tinh B63', 'VNM');
INSERT INTO `core_address` VALUES ('136', null, null, null, '', 'SHuyen A64', 'STinh B64', 'VNM');
INSERT INTO `core_address` VALUES ('137', null, null, null, '', 'Huyen A64', 'Tinh B64', 'VNM');
INSERT INTO `core_address` VALUES ('138', null, null, null, '', 'SHuyen A65', 'STinh B65', 'VNM');
INSERT INTO `core_address` VALUES ('139', null, null, null, '', 'Huyen A65', 'Tinh B65', 'VNM');
INSERT INTO `core_address` VALUES ('140', null, null, null, '', 'SHuyen A66', 'STinh B66', 'VNM');
INSERT INTO `core_address` VALUES ('141', null, null, null, '', 'Huyen A66', 'Tinh B66', 'VNM');
INSERT INTO `core_address` VALUES ('142', null, null, null, '', 'SHuyen A67', 'STinh B67', 'VNM');
INSERT INTO `core_address` VALUES ('143', null, null, null, '', 'Huyen A67', 'Tinh B67', 'VNM');
INSERT INTO `core_address` VALUES ('144', null, null, null, '', 'SHuyen A68', 'STinh B68', 'VNM');
INSERT INTO `core_address` VALUES ('145', null, null, null, '', 'Huyen A68', 'Tinh B68', 'VNM');
INSERT INTO `core_address` VALUES ('146', null, null, null, '', 'SHuyen A69', 'STinh B69', 'VNM');
INSERT INTO `core_address` VALUES ('147', null, null, null, '', 'Huyen A69', 'Tinh B69', 'VNM');
INSERT INTO `core_address` VALUES ('148', null, null, null, '', 'SHuyen A70', 'STinh B70', 'VNM');
INSERT INTO `core_address` VALUES ('149', null, null, null, '', 'Huyen A70', 'Tinh B70', 'VNM');
INSERT INTO `core_address` VALUES ('150', null, null, null, '', 'SHuyen A71', 'STinh B71', 'VNM');
INSERT INTO `core_address` VALUES ('151', null, null, null, '', 'Huyen A71', 'Tinh B71', 'VNM');
INSERT INTO `core_address` VALUES ('152', null, null, null, '', 'SHuyen A72', 'STinh B72', 'VNM');
INSERT INTO `core_address` VALUES ('153', null, null, null, '', 'Huyen A72', 'Tinh B72', 'VNM');
INSERT INTO `core_address` VALUES ('154', null, null, null, '', 'SHuyen A73', 'STinh B73', 'VNM');
INSERT INTO `core_address` VALUES ('155', null, null, null, '', 'Huyen A73', 'Tinh B73', 'VNM');
INSERT INTO `core_address` VALUES ('156', null, null, null, '', 'SHuyen A74', 'STinh B74', 'VNM');
INSERT INTO `core_address` VALUES ('157', null, null, null, '', 'Huyen A74', 'Tinh B74', 'VNM');
INSERT INTO `core_address` VALUES ('158', null, null, null, '', 'SHuyen A75', 'STinh B75', 'VNM');
INSERT INTO `core_address` VALUES ('159', null, null, null, '', 'Huyen A75', 'Tinh B75', 'VNM');
INSERT INTO `core_address` VALUES ('160', null, null, null, '', 'SHuyen A76', 'STinh B76', 'VNM');
INSERT INTO `core_address` VALUES ('161', null, null, null, '', 'Huyen A76', 'Tinh B76', 'VNM');
INSERT INTO `core_address` VALUES ('162', null, null, null, '', 'SHuyen A77', 'STinh B77', 'VNM');
INSERT INTO `core_address` VALUES ('163', null, null, null, '', 'Huyen A77', 'Tinh B77', 'VNM');
INSERT INTO `core_address` VALUES ('164', null, null, null, '', 'SHuyen A1', 'STinh B1', 'VNM');
INSERT INTO `core_address` VALUES ('165', null, null, null, '', 'SHuyen A2', 'STinh B2', 'VNM');
INSERT INTO `core_address` VALUES ('166', null, null, null, '', 'SHuyen A3', 'STinh B3', 'VNM');
INSERT INTO `core_address` VALUES ('167', null, null, null, '', 'SHuyen A4', 'STinh B4', 'VNM');
INSERT INTO `core_address` VALUES ('168', null, null, null, '', 'Huyen A5', 'Tinh B5', 'VNM');
INSERT INTO `core_address` VALUES ('169', null, null, null, '', 'SHuyen A6', 'STinh B6', 'VNM');
INSERT INTO `core_address` VALUES ('170', null, null, null, '', 'Huyen A6', 'Tinh B6', 'VNM');
INSERT INTO `core_address` VALUES ('171', null, null, null, '', 'SHuyen A7', 'STinh B7', 'VNM');
INSERT INTO `core_address` VALUES ('172', null, null, null, '', 'Huyen A7', 'Tinh B7', 'VNM');
INSERT INTO `core_address` VALUES ('173', null, null, null, '', 'SHuyen A8', 'STinh B8', 'VNM');
INSERT INTO `core_address` VALUES ('174', null, null, null, '', 'Huyen A8', 'Tinh B8', 'VNM');
INSERT INTO `core_address` VALUES ('175', null, null, null, '', 'SHuyen A9', 'STinh B9', 'VNM');
INSERT INTO `core_address` VALUES ('176', null, null, null, '', 'Huyen A9', 'Tinh B9', 'VNM');
INSERT INTO `core_address` VALUES ('177', null, null, null, '', 'SHuyen A10', 'STinh B10', 'VNM');
INSERT INTO `core_address` VALUES ('178', null, null, null, '', 'Huyen A10', 'Tinh B10', 'VNM');
INSERT INTO `core_address` VALUES ('179', null, null, null, '', 'SHuyen A11', 'STinh B11', 'VNM');
INSERT INTO `core_address` VALUES ('180', null, null, null, '', 'Huyen A11', 'Tinh B11', 'VNM');
INSERT INTO `core_address` VALUES ('181', null, null, null, '', 'SHuyen A12', 'STinh B12', 'VNM');
INSERT INTO `core_address` VALUES ('182', null, null, null, '', 'Huyen A12', 'Tinh B12', 'VNM');
INSERT INTO `core_address` VALUES ('183', null, null, null, '', 'SHuyen A13', 'STinh B13', 'VNM');
INSERT INTO `core_address` VALUES ('184', null, null, null, '', 'Huyen A13', 'Tinh B13', 'VNM');
INSERT INTO `core_address` VALUES ('185', null, null, null, '', 'SHuyen A14', 'STinh B14', 'VNM');
INSERT INTO `core_address` VALUES ('186', null, null, null, '', 'Huyen A14', 'Tinh B14', 'VNM');
INSERT INTO `core_address` VALUES ('187', null, null, null, '', 'SHuyen A15', 'STinh B15', 'VNM');
INSERT INTO `core_address` VALUES ('188', null, null, null, '', 'Huyen A15', 'Tinh B15', 'VNM');
INSERT INTO `core_address` VALUES ('189', null, null, null, '', 'SHuyen A16', 'STinh B16', 'VNM');
INSERT INTO `core_address` VALUES ('190', null, null, null, '', 'Huyen A16', 'Tinh B16', 'VNM');
INSERT INTO `core_address` VALUES ('191', null, null, null, '', 'SHuyen A17', 'STinh B17', 'VNM');
INSERT INTO `core_address` VALUES ('192', null, null, null, '', 'Huyen A17', 'Tinh B17', 'VNM');
INSERT INTO `core_address` VALUES ('193', null, null, null, '', 'SHuyen A18', 'STinh B18', 'VNM');
INSERT INTO `core_address` VALUES ('194', null, null, null, '', 'Huyen A18', 'Tinh B18', 'VNM');
INSERT INTO `core_address` VALUES ('195', null, null, null, '', 'SHuyen A19', 'STinh B19', 'VNM');
INSERT INTO `core_address` VALUES ('196', null, null, null, '', 'Huyen A19', 'Tinh B19', 'VNM');
INSERT INTO `core_address` VALUES ('197', null, null, null, '', 'SHuyen A20', 'STinh B20', 'VNM');
INSERT INTO `core_address` VALUES ('198', null, null, null, '', 'Huyen A20', 'Tinh B20', 'VNM');
INSERT INTO `core_address` VALUES ('199', null, null, null, '', 'SHuyen A21', 'STinh B21', 'VNM');
INSERT INTO `core_address` VALUES ('200', null, null, null, '', 'Huyen A21', 'Tinh B21', 'VNM');
INSERT INTO `core_address` VALUES ('201', null, null, null, '', 'SHuyen A22', 'STinh B22', 'VNM');
INSERT INTO `core_address` VALUES ('202', null, null, null, '', 'Huyen A22', 'Tinh B22', 'VNM');
INSERT INTO `core_address` VALUES ('203', null, null, null, '', 'SHuyen A23', 'STinh B23', 'VNM');
INSERT INTO `core_address` VALUES ('204', null, null, null, '', 'Huyen A23', 'Tinh B23', 'VNM');
INSERT INTO `core_address` VALUES ('205', null, null, null, '', 'SHuyen A24', 'STinh B24', 'VNM');
INSERT INTO `core_address` VALUES ('206', null, null, null, '', 'Huyen A24', 'Tinh B24', 'VNM');
INSERT INTO `core_address` VALUES ('207', null, null, null, '', 'SHuyen A25', 'STinh B25', 'VNM');
INSERT INTO `core_address` VALUES ('208', null, null, null, '', 'Huyen A25', 'Tinh B25', 'VNM');
INSERT INTO `core_address` VALUES ('209', null, null, null, '', 'SHuyen A26', 'STinh B26', 'VNM');
INSERT INTO `core_address` VALUES ('210', null, null, null, '', 'Huyen A26', 'Tinh B26', 'VNM');
INSERT INTO `core_address` VALUES ('211', null, null, null, '', 'SHuyen A27', 'STinh B27', 'VNM');
INSERT INTO `core_address` VALUES ('212', null, null, null, '', 'Huyen A27', 'Tinh B27', 'VNM');
INSERT INTO `core_address` VALUES ('213', null, null, null, '', 'SHuyen A28', 'STinh B28', 'VNM');
INSERT INTO `core_address` VALUES ('214', null, null, null, '', 'Huyen A28', 'Tinh B28', 'VNM');
INSERT INTO `core_address` VALUES ('215', null, null, null, '', 'SHuyen A29', 'STinh B29', 'VNM');
INSERT INTO `core_address` VALUES ('216', null, null, null, '', 'Huyen A29', 'Tinh B29', 'VNM');
INSERT INTO `core_address` VALUES ('217', null, null, null, '', 'SHuyen A30', 'STinh B30', 'VNM');
INSERT INTO `core_address` VALUES ('218', null, null, null, '', 'Huyen A30', 'Tinh B30', 'VNM');
INSERT INTO `core_address` VALUES ('219', null, null, null, '', 'SHuyen A31', 'STinh B31', 'VNM');
INSERT INTO `core_address` VALUES ('220', null, null, null, '', 'Huyen A31', 'Tinh B31', 'VNM');
INSERT INTO `core_address` VALUES ('221', null, null, null, '', 'SHuyen A32', 'STinh B32', 'VNM');
INSERT INTO `core_address` VALUES ('222', null, null, null, '', 'Huyen A32', 'Tinh B32', 'VNM');
INSERT INTO `core_address` VALUES ('223', null, null, null, '', 'SHuyen A33', 'STinh B33', 'VNM');
INSERT INTO `core_address` VALUES ('224', null, null, null, '', 'Huyen A33', 'Tinh B33', 'VNM');
INSERT INTO `core_address` VALUES ('225', null, null, null, '', 'SHuyen A34', 'STinh B34', 'VNM');
INSERT INTO `core_address` VALUES ('226', null, null, null, '', 'Huyen A34', 'Tinh B34', 'VNM');
INSERT INTO `core_address` VALUES ('227', null, null, null, '', 'SHuyen A35', 'STinh B35', 'VNM');
INSERT INTO `core_address` VALUES ('228', null, null, null, '', 'Huyen A35', 'Tinh B35', 'VNM');
INSERT INTO `core_address` VALUES ('229', null, null, null, '', 'SHuyen A36', 'STinh B36', 'VNM');
INSERT INTO `core_address` VALUES ('230', null, null, null, '', 'Huyen A36', 'Tinh B36', 'VNM');
INSERT INTO `core_address` VALUES ('231', null, null, null, '', 'SHuyen A37', 'STinh B37', 'VNM');
INSERT INTO `core_address` VALUES ('232', null, null, null, '', 'Huyen A37', 'Tinh B37', 'VNM');
INSERT INTO `core_address` VALUES ('233', null, null, null, '', 'SHuyen A38', 'STinh B38', 'VNM');
INSERT INTO `core_address` VALUES ('234', null, null, null, '', 'Huyen A38', 'Tinh B38', 'VNM');
INSERT INTO `core_address` VALUES ('235', null, null, null, '', 'SHuyen A39', 'STinh B39', 'VNM');
INSERT INTO `core_address` VALUES ('236', null, null, null, '', 'Huyen A39', 'Tinh B39', 'VNM');
INSERT INTO `core_address` VALUES ('237', null, null, null, '', 'SHuyen A40', 'STinh B40', 'VNM');
INSERT INTO `core_address` VALUES ('238', null, null, null, '', 'Huyen A40', 'Tinh B40', 'VNM');
INSERT INTO `core_address` VALUES ('239', null, null, null, '', 'SHuyen A41', 'STinh B41', 'VNM');
INSERT INTO `core_address` VALUES ('240', null, null, null, '', 'Huyen A41', 'Tinh B41', 'VNM');
INSERT INTO `core_address` VALUES ('241', null, null, null, '', 'SHuyen A42', 'STinh B42', 'VNM');
INSERT INTO `core_address` VALUES ('242', null, null, null, '', 'Huyen A42', 'Tinh B42', 'VNM');
INSERT INTO `core_address` VALUES ('243', null, null, null, '', 'SHuyen A43', 'STinh B43', 'VNM');
INSERT INTO `core_address` VALUES ('244', null, null, null, '', 'Huyen A43', 'Tinh B43', 'VNM');
INSERT INTO `core_address` VALUES ('245', null, null, null, '', 'SHuyen A44', 'STinh B44', 'VNM');
INSERT INTO `core_address` VALUES ('246', null, null, null, '', 'Huyen A44', 'Tinh B44', 'VNM');
INSERT INTO `core_address` VALUES ('247', null, null, null, '', 'SHuyen A45', 'STinh B45', 'VNM');
INSERT INTO `core_address` VALUES ('248', null, null, null, '', 'Huyen A45', 'Tinh B45', 'VNM');
INSERT INTO `core_address` VALUES ('249', null, null, null, '', 'SHuyen A46', 'STinh B46', 'VNM');
INSERT INTO `core_address` VALUES ('250', null, null, null, '', 'Huyen A46', 'Tinh B46', 'VNM');
INSERT INTO `core_address` VALUES ('251', null, null, null, '', 'SHuyen A47', 'STinh B47', 'VNM');
INSERT INTO `core_address` VALUES ('252', null, null, null, '', 'Huyen A47', 'Tinh B47', 'VNM');
INSERT INTO `core_address` VALUES ('253', null, null, null, '', 'SHuyen A48', 'STinh B48', 'VNM');
INSERT INTO `core_address` VALUES ('254', null, null, null, '', 'Huyen A48', 'Tinh B48', 'VNM');
INSERT INTO `core_address` VALUES ('255', null, null, null, '', 'SHuyen A49', 'STinh B49', 'VNM');
INSERT INTO `core_address` VALUES ('256', null, null, null, '', 'Huyen A49', 'Tinh B49', 'VNM');
INSERT INTO `core_address` VALUES ('257', null, null, null, '', 'SHuyen A50', 'STinh B50', 'VNM');
INSERT INTO `core_address` VALUES ('258', null, null, null, '', 'Huyen A50', 'Tinh B50', 'VNM');
INSERT INTO `core_address` VALUES ('259', null, null, null, '', 'SHuyen A51', 'STinh B51', 'VNM');
INSERT INTO `core_address` VALUES ('260', null, null, null, '', 'Huyen A51', 'Tinh B51', 'VNM');
INSERT INTO `core_address` VALUES ('261', null, null, null, '', 'SHuyen A52', 'STinh B52', 'VNM');
INSERT INTO `core_address` VALUES ('262', null, null, null, '', 'Huyen A52', 'Tinh B52', 'VNM');
INSERT INTO `core_address` VALUES ('263', null, null, null, '', 'SHuyen A53', 'STinh B53', 'VNM');
INSERT INTO `core_address` VALUES ('264', null, null, null, '', 'Huyen A53', 'Tinh B53', 'VNM');
INSERT INTO `core_address` VALUES ('265', null, null, null, '', 'SHuyen A54', 'STinh B54', 'VNM');
INSERT INTO `core_address` VALUES ('266', null, null, null, '', 'Huyen A54', 'Tinh B54', 'VNM');
INSERT INTO `core_address` VALUES ('267', null, null, null, '', 'SHuyen A55', 'STinh B55', 'VNM');
INSERT INTO `core_address` VALUES ('268', null, null, null, '', 'Huyen A55', 'Tinh B55', 'VNM');
INSERT INTO `core_address` VALUES ('269', null, null, null, '', 'SHuyen A56', 'STinh B56', 'VNM');
INSERT INTO `core_address` VALUES ('270', null, null, null, '', 'Huyen A56', 'Tinh B56', 'VNM');
INSERT INTO `core_address` VALUES ('271', null, null, null, '', 'SHuyen A57', 'STinh B57', 'VNM');
INSERT INTO `core_address` VALUES ('272', null, null, null, '', 'Huyen A57', 'Tinh B57', 'VNM');
INSERT INTO `core_address` VALUES ('273', null, null, null, '', 'SHuyen A58', 'STinh B58', 'VNM');
INSERT INTO `core_address` VALUES ('274', null, null, null, '', 'Huyen A58', 'Tinh B58', 'VNM');
INSERT INTO `core_address` VALUES ('275', null, null, null, '', 'SHuyen A59', 'STinh B59', 'VNM');
INSERT INTO `core_address` VALUES ('276', null, null, null, '', 'Huyen A59', 'Tinh B59', 'VNM');
INSERT INTO `core_address` VALUES ('277', null, null, null, '', 'SHuyen A60', 'STinh B60', 'VNM');
INSERT INTO `core_address` VALUES ('278', null, null, null, '', 'Huyen A60', 'Tinh B60', 'VNM');
INSERT INTO `core_address` VALUES ('279', null, null, null, '', 'SHuyen A61', 'STinh B61', 'VNM');
INSERT INTO `core_address` VALUES ('280', null, null, null, '', 'Huyen A61', 'Tinh B61', 'VNM');
INSERT INTO `core_address` VALUES ('281', null, null, null, '', 'SHuyen A62', 'STinh B62', 'VNM');
INSERT INTO `core_address` VALUES ('282', null, null, null, '', 'Huyen A62', 'Tinh B62', 'VNM');
INSERT INTO `core_address` VALUES ('283', null, null, null, '', 'SHuyen A63', 'STinh B63', 'VNM');
INSERT INTO `core_address` VALUES ('284', null, null, null, '', 'Huyen A63', 'Tinh B63', 'VNM');
INSERT INTO `core_address` VALUES ('285', null, null, null, '', 'SHuyen A64', 'STinh B64', 'VNM');
INSERT INTO `core_address` VALUES ('286', null, null, null, '', 'Huyen A64', 'Tinh B64', 'VNM');
INSERT INTO `core_address` VALUES ('287', null, null, null, '', 'SHuyen A65', 'STinh B65', 'VNM');
INSERT INTO `core_address` VALUES ('288', null, null, null, '', 'Huyen A65', 'Tinh B65', 'VNM');
INSERT INTO `core_address` VALUES ('289', null, null, null, '', 'SHuyen A66', 'STinh B66', 'VNM');
INSERT INTO `core_address` VALUES ('290', null, null, null, '', 'Huyen A66', 'Tinh B66', 'VNM');
INSERT INTO `core_address` VALUES ('291', null, null, null, '', 'SHuyen A67', 'STinh B67', 'VNM');
INSERT INTO `core_address` VALUES ('292', null, null, null, '', 'Huyen A67', 'Tinh B67', 'VNM');
INSERT INTO `core_address` VALUES ('293', null, null, null, '', 'SHuyen A68', 'STinh B68', 'VNM');
INSERT INTO `core_address` VALUES ('294', null, null, null, '', 'Huyen A68', 'Tinh B68', 'VNM');
INSERT INTO `core_address` VALUES ('295', null, null, null, '', 'SHuyen A69', 'STinh B69', 'VNM');
INSERT INTO `core_address` VALUES ('296', null, null, null, '', 'Huyen A69', 'Tinh B69', 'VNM');
INSERT INTO `core_address` VALUES ('297', null, null, null, '', 'SHuyen A70', 'STinh B70', 'VNM');
INSERT INTO `core_address` VALUES ('298', null, null, null, '', 'Huyen A70', 'Tinh B70', 'VNM');
INSERT INTO `core_address` VALUES ('299', null, null, null, '', 'SHuyen A71', 'STinh B71', 'VNM');
INSERT INTO `core_address` VALUES ('300', null, null, null, '', 'Huyen A71', 'Tinh B71', 'VNM');
INSERT INTO `core_address` VALUES ('301', null, null, null, '', 'SHuyen A72', 'STinh B72', 'VNM');
INSERT INTO `core_address` VALUES ('302', null, null, null, '', 'Huyen A72', 'Tinh B72', 'VNM');
INSERT INTO `core_address` VALUES ('303', null, null, null, '', 'SHuyen A73', 'STinh B73', 'VNM');
INSERT INTO `core_address` VALUES ('304', null, null, null, '', 'Huyen A73', 'Tinh B73', 'VNM');
INSERT INTO `core_address` VALUES ('305', null, null, null, '', 'SHuyen A74', 'STinh B74', 'VNM');
INSERT INTO `core_address` VALUES ('306', null, null, null, '', 'Huyen A74', 'Tinh B74', 'VNM');
INSERT INTO `core_address` VALUES ('307', null, null, null, '', 'SHuyen A75', 'STinh B75', 'VNM');
INSERT INTO `core_address` VALUES ('308', null, null, null, '', 'Huyen A75', 'Tinh B75', 'VNM');
INSERT INTO `core_address` VALUES ('309', null, null, null, '', 'SHuyen A76', 'STinh B76', 'VNM');
INSERT INTO `core_address` VALUES ('310', null, null, null, '', 'Huyen A76', 'Tinh B76', 'VNM');
INSERT INTO `core_address` VALUES ('311', null, null, null, '', 'SHuyen A77', 'STinh B77', 'VNM');
INSERT INTO `core_address` VALUES ('312', null, null, null, '', 'Huyen A77', 'Tinh B77', 'VNM');
INSERT INTO `core_address` VALUES ('313', '', 'Xuân Hòa - Phúc Yên - Vĩnh Phúc', '', '', '', '', 'VNM');

-- ----------------------------
-- Table structure for core_answer
-- ----------------------------
DROP TABLE IF EXISTS `core_answer`;
CREATE TABLE `core_answer` (
  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer_content` text COLLATE utf8_unicode_ci,
  `answer_question` int(10) DEFAULT NULL,
  `answer_is_correct` tinyint(1) DEFAULT '0',
  `answer_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=543 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_answer
-- ----------------------------
INSERT INTO `core_answer` VALUES ('1', '3232', '4', '1', '2015-03-07 16:34:13');
INSERT INTO `core_answer` VALUES ('2', '23322', '4', '0', '2015-03-07 16:34:13');
INSERT INTO `core_answer` VALUES ('3', '232', '5', '1', '2015-03-07 16:34:40');
INSERT INTO `core_answer` VALUES ('4', '23232', '5', '1', '2015-03-07 16:34:40');
INSERT INTO `core_answer` VALUES ('5', '23r42r2', '5', '1', '2015-03-07 16:34:40');
INSERT INTO `core_answer` VALUES ('10', '2', '1', '1', '2015-03-11 07:32:31');
INSERT INTO `core_answer` VALUES ('11', '4', '1', '0', '2015-03-11 07:32:31');
INSERT INTO `core_answer` VALUES ('32', 'Từ một loài vượn cổ', '11', '1', '2015-03-25 16:37:24');
INSERT INTO `core_answer` VALUES ('33', 'Từ một loài vượn', '11', '0', '2015-03-25 16:37:24');
INSERT INTO `core_answer` VALUES ('34', 'Do thần thánh sáng tạo ra', '11', '0', '2015-03-25 16:37:24');
INSERT INTO `core_answer` VALUES ('35', 'Từ động vật', '11', '0', '2015-03-25 16:37:24');
INSERT INTO `core_answer` VALUES ('36', 'Thể tích óc phát triển', '12', '0', '2015-03-25 16:38:41');
INSERT INTO `core_answer` VALUES ('37', 'Bàn tay khéo léo', '12', '0', '2015-03-25 16:38:41');
INSERT INTO `core_answer` VALUES ('38', 'Óc sáng tạo', '12', '1', '2015-03-25 16:38:41');
INSERT INTO `core_answer` VALUES ('39', 'Xương cốt nhỏ', '12', '0', '2015-03-25 16:38:41');
INSERT INTO `core_answer` VALUES ('44', 'Thể hiện sức mạnh của đất nước &nbsp; &nbsp; &nbsp; &nbsp;', '14', '0', '2015-03-26 08:55:15');
INSERT INTO `core_answer` VALUES ('45', 'Thể hiện sức mạnh của thần thỏnhThể hiện sức mạnh của thần thánh', '14', '0', '2015-03-26 08:55:15');
INSERT INTO `core_answer` VALUES ('46', 'Thể hiện sức mạnh và uy\r\nquyền của nhà vua', '14', '1', '2015-03-26 08:55:15');
INSERT INTO `core_answer` VALUES ('47', 'Thể hiện tình đoàn kết dân tộc', '14', '0', '2015-03-26 08:55:15');
INSERT INTO `core_answer` VALUES ('48', 'Sưởi ấm', '13', '0', '2015-03-26 08:55:31');
INSERT INTO `core_answer` VALUES ('49', 'Nấu chín thức ăn', '13', '0', '2015-03-26 08:55:31');
INSERT INTO `core_answer` VALUES ('50', 'Xua đuổi thú dữ', '13', '0', '2015-03-26 08:55:31');
INSERT INTO `core_answer` VALUES ('51', 'Cả a, b,c.', '13', '1', '2015-03-26 08:55:31');
INSERT INTO `core_answer` VALUES ('52', '&nbsp;PDF', '15', '0', '2015-03-26 08:59:35');
INSERT INTO `core_answer` VALUES ('53', 'XLS', '15', '0', '2015-03-26 08:59:35');
INSERT INTO `core_answer` VALUES ('54', '&nbsp;TXT', '15', '0', '2015-03-26 08:59:35');
INSERT INTO `core_answer` VALUES ('55', 'DOC', '15', '1', '2015-03-26 08:59:35');
INSERT INTO `core_answer` VALUES ('56', 'Tổ hợp phím CTRL +L', '16', '0', '2015-03-26 09:00:42');
INSERT INTO `core_answer` VALUES ('57', '&nbsp;Tổ hợp phím CTRL\r\n+R', '16', '1', '2015-03-26 09:00:42');
INSERT INTO `core_answer` VALUES ('58', 'Tổ hợp phím CTRL +J', '16', '0', '2015-03-26 09:00:42');
INSERT INTO `core_answer` VALUES ('59', '&nbsp;&nbsp;Tổ hợp phím CTRL +E', '16', '0', '2015-03-26 09:00:42');
INSERT INTO `core_answer` VALUES ('60', 'Tổ hợp phím CTRL +E', '17', '1', '2015-03-26 09:01:54');
INSERT INTO `core_answer` VALUES ('61', 'Vào menu Format -&gt; Tabs', '17', '0', '2015-03-26 09:01:54');
INSERT INTO `core_answer` VALUES ('62', 'Tổ hợp phím CTRL +E', '17', '0', '2015-03-26 09:01:54');
INSERT INTO `core_answer` VALUES ('63', 'Vào menu View -&gt; Page Numbers', '17', '0', '2015-03-26 09:01:54');
INSERT INTO `core_answer` VALUES ('64', 'CTRL + Z', '18', '1', '2015-03-26 09:02:59');
INSERT INTO `core_answer` VALUES ('65', 'CTRL + C', '18', '0', '2015-03-26 09:02:59');
INSERT INTO `core_answer` VALUES ('66', '&nbsp;CTRL + X', '18', '0', '2015-03-26 09:02:59');
INSERT INTO `core_answer` VALUES ('67', '&nbsp;CTRL + V', '18', '0', '2015-03-26 09:02:59');
INSERT INTO `core_answer` VALUES ('68', '&nbsp;&nbsp;Chỉ bôi đen chữ Power nhất tổ hợp phím CTRL +U', '19', '0', '2015-03-26 09:04:32');
INSERT INTO `core_answer` VALUES ('69', 'Nhấn tổ hợp phím CTRL +U + B', '19', '0', '2015-03-26 09:04:32');
INSERT INTO `core_answer` VALUES ('70', 'Đưa con trỏ văn bản đến chữ “Powerpoint” và\r\nnhấn tổ hợp CTRL + U rồi CTRL + B', '19', '1', '2015-03-26 09:04:32');
INSERT INTO `core_answer` VALUES ('71', 'Đưa con trỏ văn bản đến chữ “Powerpoint” và nhấn tổ hợp &nbsp;CTRL + B&nbsp;rồi&nbsp;CTRL + U', '19', '1', '2015-03-26 09:04:32');
INSERT INTO `core_answer` VALUES ('72', '&nbsp;&nbsp;E7*F7/100', '20', '0', '2015-03-26 09:05:33');
INSERT INTO `core_answer` VALUES ('73', '&nbsp;E6*F6/100', '20', '1', '2015-03-26 09:05:33');
INSERT INTO `core_answer` VALUES ('74', 'B6*C6/100', '20', '0', '2015-03-26 09:05:33');
INSERT INTO `core_answer` VALUES ('75', '&nbsp;&nbsp;E2*C2/100', '20', '0', '2015-03-26 09:05:33');
INSERT INTO `core_answer` VALUES ('76', 'Shift – Home', '21', '0', '2015-03-26 09:07:22');
INSERT INTO `core_answer` VALUES ('77', 'Tab – Home', '21', '0', '2015-03-26 09:07:22');
INSERT INTO `core_answer` VALUES ('78', 'Ctrl – Home', '21', '1', '2015-03-26 09:07:23');
INSERT INTO `core_answer` VALUES ('79', 'Ctrl – shift – home', '21', '0', '2015-03-26 09:07:23');
INSERT INTO `core_answer` VALUES ('80', 'Vịnh Hạ Long', '22', '0', '2015-03-26 09:10:23');
INSERT INTO `core_answer` VALUES ('81', 'Phong Nha', '22', '0', '2015-03-26 09:10:23');
INSERT INTO `core_answer` VALUES ('82', 'Thánh địa Mỹ Sơn', '22', '0', '2015-03-26 09:10:23');
INSERT INTO `core_answer` VALUES ('83', 'Núi Phanxipang', '22', '1', '2015-03-26 09:10:23');
INSERT INTO `core_answer` VALUES ('84', 'Xích đạo', '23', '0', '2015-03-26 09:11:56');
INSERT INTO `core_answer` VALUES ('85', 'Chí tuyến', '23', '0', '2015-03-26 09:11:56');
INSERT INTO `core_answer` VALUES ('86', 'Cực', '23', '0', '2015-03-26 09:11:56');
INSERT INTO `core_answer` VALUES ('87', 'Vòng Cực', '23', '1', '2015-03-26 09:11:56');
INSERT INTO `core_answer` VALUES ('88', 'TAM', '24', '0', '2015-03-26 09:12:51');
INSERT INTO `core_answer` VALUES ('89', 'ATM', '24', '0', '2015-03-26 09:12:51');
INSERT INTO `core_answer` VALUES ('90', 'GMT', '24', '1', '2015-03-26 09:12:51');
INSERT INTO `core_answer` VALUES ('91', 'GTM', '24', '0', '2015-03-26 09:12:51');
INSERT INTO `core_answer` VALUES ('96', 'Thứ 1', '25', '0', '2015-03-26 09:13:59');
INSERT INTO `core_answer` VALUES ('97', 'Thứ 2', '25', '0', '2015-03-26 09:13:59');
INSERT INTO `core_answer` VALUES ('98', 'Thứ 3', '25', '1', '2015-03-26 09:13:59');
INSERT INTO `core_answer` VALUES ('99', 'Thứ 4', '25', '0', '2015-03-26 09:13:59');
INSERT INTO `core_answer` VALUES ('100', '1825', '26', '0', '2015-03-26 10:05:39');
INSERT INTO `core_answer` VALUES ('101', '1852', '26', '0', '2015-03-26 10:05:39');
INSERT INTO `core_answer` VALUES ('102', '1925', '26', '1', '2015-03-26 10:05:39');
INSERT INTO `core_answer` VALUES ('103', '1952', '26', '0', '2015-03-26 10:05:39');
INSERT INTO `core_answer` VALUES ('104', 'Tượng hoặc ảnh Bác Hồ, quốc kỳ, khẩu hiệu, biểu trưng', '27', '1', '2015-03-26 10:07:13');
INSERT INTO `core_answer` VALUES ('105', 'Vài màu, bàn ghế, khẩu hiệu, trống – kèn', '27', '0', '2015-03-26 10:07:13');
INSERT INTO `core_answer` VALUES ('106', 'Bàn ghế, biểu trưng, pano, tranh quảng cáo', '27', '0', '2015-03-26 10:07:13');
INSERT INTO `core_answer` VALUES ('107', 'Biểu trưng, khẩu hiệu, vải màu, tranh phong cảnh', '27', '0', '2015-03-26 10:07:13');
INSERT INTO `core_answer` VALUES ('108', 'Cung đình', '28', '0', '2015-03-26 10:08:07');
INSERT INTO `core_answer` VALUES ('109', 'Phật giáo', '28', '0', '2015-03-26 10:08:07');
INSERT INTO `core_answer` VALUES ('110', 'Châu âu', '28', '0', '2015-03-26 10:08:07');
INSERT INTO `core_answer` VALUES ('111', 'Truyền thống của nước ta', '28', '1', '2015-03-26 10:08:07');
INSERT INTO `core_answer` VALUES ('112', 'Vẽ hình, tìm và chọn nội dung, vẽ màu', '29', '0', '2015-03-26 10:09:00');
INSERT INTO `core_answer` VALUES ('113', 'Phác bố cục, tìm và chọn nội dung, vẽ màu, vẽ hình', '29', '0', '2015-03-26 10:09:00');
INSERT INTO `core_answer` VALUES ('114', 'Tìm và chọn nội dung, phác mảng hình chính, mảng phụ, sắp xếp bố cục, vẽ chi tiết, vẽ màu', '29', '1', '2015-03-26 10:09:00');
INSERT INTO `core_answer` VALUES ('115', 'Phác hình, vẽ màu, chọn hình ảnh', '29', '0', '2015-03-26 10:09:00');
INSERT INTO `core_answer` VALUES ('116', 'Có bốn cột và có nhiều cửa', '30', '0', '2015-03-26 10:09:43');
INSERT INTO `core_answer` VALUES ('117', 'Nhà vừa hẹp vừa dài và lợp bằng mái ngói', '30', '0', '2015-03-26 10:09:43');
INSERT INTO `core_answer` VALUES ('118', 'Xây bằng chất liệu cao cấp', '30', '0', '2015-03-26 10:09:43');
INSERT INTO `core_answer` VALUES ('119', 'To và cao được trang trí công phu', '30', '1', '2015-03-26 10:09:43');
INSERT INTO `core_answer` VALUES ('120', 'Nguyễn Đỗ Cung', '31', '0', '2015-03-26 10:10:43');
INSERT INTO `core_answer` VALUES ('121', 'Tô Ngọc Vân', '31', '0', '2015-03-26 10:10:43');
INSERT INTO `core_answer` VALUES ('122', 'Nguyễn Phan Chánh', '31', '1', '2015-03-26 10:10:43');
INSERT INTO `core_answer` VALUES ('123', 'Bùi Xuân Phái', '31', '0', '2015-03-26 10:10:43');
INSERT INTO `core_answer` VALUES ('124', 'Màu bột', '32', '0', '2015-03-26 10:11:35');
INSERT INTO `core_answer` VALUES ('125', 'Sơn dầu', '32', '1', '2015-03-26 10:11:35');
INSERT INTO `core_answer` VALUES ('126', 'Lụa', '32', '0', '2015-03-26 10:11:35');
INSERT INTO `core_answer` VALUES ('127', 'Sơn mài', '32', '0', '2015-03-26 10:11:35');
INSERT INTO `core_answer` VALUES ('128', '1 phách', '33', '0', '2015-03-26 10:13:53');
INSERT INTO `core_answer` VALUES ('129', '2 phách', '33', '0', '2015-03-26 10:13:53');
INSERT INTO `core_answer` VALUES ('130', '3 phách', '33', '1', '2015-03-26 10:13:53');
INSERT INTO `core_answer` VALUES ('131', '4 phách', '33', '0', '2015-03-26 10:13:53');
INSERT INTO `core_answer` VALUES ('132', 'Áo', '34', '1', '2015-03-26 10:14:50');
INSERT INTO `core_answer` VALUES ('133', 'Anh', '34', '0', '2015-03-26 10:14:50');
INSERT INTO `core_answer` VALUES ('134', 'Pháp', '34', '0', '2015-03-26 10:14:50');
INSERT INTO `core_answer` VALUES ('135', 'Italia', '34', '0', '2015-03-26 10:14:50');
INSERT INTO `core_answer` VALUES ('136', 'Liên kết 2 nốt nhạc có độ cao khác nhau', '35', '0', '2015-03-26 10:15:36');
INSERT INTO `core_answer` VALUES ('137', 'Liên kết 2 hay nhiều nốt nhạc có độ cao khác nhau', '35', '0', '2015-03-26 10:15:36');
INSERT INTO `core_answer` VALUES ('138', 'Liên kết trường độ 2 hay nhiều nốt nhạc cùng độ cao', '35', '1', '2015-03-26 10:15:36');
INSERT INTO `core_answer` VALUES ('139', 'Cả 3 đáp án đều đúng', '35', '0', '2015-03-26 10:15:36');
INSERT INTO `core_answer` VALUES ('140', 'Nguyễn Ngọc Thiện', '36', '0', '2015-03-26 10:16:56');
INSERT INTO `core_answer` VALUES ('141', 'Phong Nhã', '36', '1', '2015-03-26 10:16:56');
INSERT INTO `core_answer` VALUES ('142', 'Văn Chung', '36', '0', '2015-03-26 10:16:56');
INSERT INTO `core_answer` VALUES ('143', 'Nguyễn Huy Hùng', '36', '0', '2015-03-26 10:16:56');
INSERT INTO `core_answer` VALUES ('144', 'Hô –la –hê, Hô –la-hô', '37', '0', '2015-03-26 10:19:35');
INSERT INTO `core_answer` VALUES ('145', 'Ngày đầu tiên đi học', '37', '0', '2015-03-26 10:19:35');
INSERT INTO `core_answer` VALUES ('146', 'Tia nắng hạt mưa', '37', '0', '2015-03-26 10:19:35');
INSERT INTO `core_answer` VALUES ('147', 'Niềm vui của em', '37', '1', '2015-03-26 10:19:35');
INSERT INTO `core_answer` VALUES ('148', 'Copernic', '38', '0', '2015-03-26 10:26:29');
INSERT INTO `core_answer` VALUES ('149', 'Aristote', '38', '1', '2015-03-26 10:26:29');
INSERT INTO `core_answer` VALUES ('150', 'Magellen', '38', '0', '2015-03-26 10:26:29');
INSERT INTO `core_answer` VALUES ('151', 'Galileo', '38', '0', '2015-03-26 10:26:29');
INSERT INTO `core_answer` VALUES ('152', 'Địa tâm', '39', '0', '2015-03-26 10:27:08');
INSERT INTO `core_answer` VALUES ('153', 'Nhật tâm', '39', '1', '2015-03-26 10:27:08');
INSERT INTO `core_answer` VALUES ('154', 'Ba định luật Niuton', '39', '0', '2015-03-26 10:27:08');
INSERT INTO `core_answer` VALUES ('155', 'Chùm sáng có mức năng lượng lớn', '40', '0', '2015-03-26 10:28:07');
INSERT INTO `core_answer` VALUES ('156', 'Chùm sáng tạo ra ảnh thật', '40', '0', '2015-03-26 10:28:07');
INSERT INTO `core_answer` VALUES ('157', 'Chùm sáng giao nhau tại một điểm', '40', '1', '2015-03-26 10:28:07');
INSERT INTO `core_answer` VALUES ('158', 'Chùm sáng có các tia sáng nằm trên cùng mặt phẳng', '40', '0', '2015-03-26 10:28:07');
INSERT INTO `core_answer` VALUES ('159', 'Tăng tốc độ quay của tuapin', '41', '0', '2015-03-26 10:42:31');
INSERT INTO `core_answer` VALUES ('160', 'Không cần thay đổi gì', '41', '0', '2015-03-26 10:42:31');
INSERT INTO `core_answer` VALUES ('161', 'Tăng hiệu điện thế ở đầu ra bằng cách thay đổi hệ số biến thế', '41', '0', '2015-03-26 10:42:31');
INSERT INTO `core_answer` VALUES ('162', 'Tăng dòng nước đổ vào tuapin để giữ tốc độ quay không đổi', '41', '1', '2015-03-26 10:42:31');
INSERT INTO `core_answer` VALUES ('163', '15-15.000Hz', '42', '0', '2015-03-26 10:43:19');
INSERT INTO `core_answer` VALUES ('164', '16-20.000Hz', '42', '1', '2015-03-26 10:43:19');
INSERT INTO `core_answer` VALUES ('165', '16-15.000Hz', '42', '0', '2015-03-26 10:43:19');
INSERT INTO `core_answer` VALUES ('166', '15-20.000Hz', '42', '0', '2015-03-26 10:43:19');
INSERT INTO `core_answer` VALUES ('167', 'Thủy tinh, 2', '43', '0', '2015-03-26 10:43:56');
INSERT INTO `core_answer` VALUES ('168', 'Kim tinh, 1', '43', '0', '2015-03-26 10:43:56');
INSERT INTO `core_answer` VALUES ('169', 'Thủy tinh, 1', '43', '0', '2015-03-26 10:43:56');
INSERT INTO `core_answer` VALUES ('170', 'Kim tinh, 2', '43', '1', '2015-03-26 10:43:56');
INSERT INTO `core_answer` VALUES ('171', 'Từ đất', '44', '0', '2015-03-26 11:03:55');
INSERT INTO `core_answer` VALUES ('172', 'Nước mưa', '44', '0', '2015-03-26 11:03:55');
INSERT INTO `core_answer` VALUES ('173', 'Phân bón', '44', '0', '2015-03-26 11:03:55');
INSERT INTO `core_answer` VALUES ('174', 'A, b, c', '44', '1', '2015-03-26 11:03:55');
INSERT INTO `core_answer` VALUES ('175', '0,25 lít', '45', '0', '2015-03-26 11:04:45');
INSERT INTO `core_answer` VALUES ('176', '0,5 lít', '45', '0', '2015-03-26 11:04:45');
INSERT INTO `core_answer` VALUES ('177', '1 lít', '45', '1', '2015-03-26 11:04:45');
INSERT INTO `core_answer` VALUES ('178', '1,5 lít', '45', '0', '2015-03-26 11:04:45');
INSERT INTO `core_answer` VALUES ('179', '10.000 lần', '46', '0', '2015-03-26 11:06:32');
INSERT INTO `core_answer` VALUES ('180', '10.500 lần', '46', '0', '2015-03-26 11:06:32');
INSERT INTO `core_answer` VALUES ('181', '11.000 lần', '46', '0', '2015-03-26 11:06:32');
INSERT INTO `core_answer` VALUES ('182', '11.500 lần', '46', '1', '2015-03-26 11:06:32');
INSERT INTO `core_answer` VALUES ('183', '0,25 lít', '47', '0', '2015-03-26 11:07:25');
INSERT INTO `core_answer` VALUES ('184', '0,5 lít', '47', '0', '2015-03-26 11:07:25');
INSERT INTO `core_answer` VALUES ('185', '1 lít', '47', '1', '2015-03-26 11:07:25');
INSERT INTO `core_answer` VALUES ('186', '1,5 lít', '47', '0', '2015-03-26 11:07:25');
INSERT INTO `core_answer` VALUES ('187', 'Con voi', '48', '0', '2015-03-26 14:01:30');
INSERT INTO `core_answer` VALUES ('188', 'Cá voi xanh', '48', '1', '2015-03-26 14:01:30');
INSERT INTO `core_answer` VALUES ('189', 'Đại bàng', '48', '0', '2015-03-26 14:01:30');
INSERT INTO `core_answer` VALUES ('190', 'Gấu', '48', '0', '2015-03-26 14:01:30');
INSERT INTO `core_answer` VALUES ('191', 'Con cái và con đực chung sống cùng nhau', '49', '0', '2015-03-26 14:02:16');
INSERT INTO `core_answer` VALUES ('192', 'Con đực ăn con cái', '49', '0', '2015-03-26 14:02:16');
INSERT INTO `core_answer` VALUES ('193', 'Con cái ăn con đực', '49', '1', '2015-03-26 14:02:16');
INSERT INTO `core_answer` VALUES ('194', 'Oxi', '50', '0', '2015-03-26 14:13:17');
INSERT INTO `core_answer` VALUES ('195', 'Nito', '50', '0', '2015-03-26 14:13:17');
INSERT INTO `core_answer` VALUES ('196', 'Hidro', '50', '1', '2015-03-26 14:13:17');
INSERT INTO `core_answer` VALUES ('197', 'Cácbon', '50', '0', '2015-03-26 14:13:17');
INSERT INTO `core_answer` VALUES ('198', 'Lutetium', '51', '0', '2015-03-26 14:13:57');
INSERT INTO `core_answer` VALUES ('199', 'Vàng', '51', '1', '2015-03-26 14:13:57');
INSERT INTO `core_answer` VALUES ('200', 'Nhôm', '51', '0', '2015-03-26 14:13:57');
INSERT INTO `core_answer` VALUES ('201', 'Lithium', '51', '0', '2015-03-26 14:13:57');
INSERT INTO `core_answer` VALUES ('202', 'Bằng Xà phòng có độ kiềm cao', '52', '0', '2015-03-26 14:14:50');
INSERT INTO `core_answer` VALUES ('203', 'Bằng nước nóng', '52', '0', '2015-03-26 14:14:50');
INSERT INTO `core_answer` VALUES ('204', 'Ủi nóng', '52', '0', '2015-03-26 14:14:50');
INSERT INTO `core_answer` VALUES ('205', 'Bằng xà phòng có độ kiềm thấp, nước ấm', '52', '1', '2015-03-26 14:14:50');
INSERT INTO `core_answer` VALUES ('206', 'Xenlulozo và tinh bột có phân tử khối nhỏ', '53', '0', '2015-03-26 14:15:42');
INSERT INTO `core_answer` VALUES ('207', 'Xenlulozo có phân tử khối nhỏ hơn tinh bột', '53', '0', '2015-03-26 14:15:42');
INSERT INTO `core_answer` VALUES ('208', 'Xenlulozo và tinh bột có phân tử khối bằng nhau', '53', '0', '2015-03-26 14:15:42');
INSERT INTO `core_answer` VALUES ('209', 'Xenlulozo và tinh bột có phân tử khối rất lớn, nhưng phân tử khối của xenlulozo lơn hơn nhiều so với tinh bột', '53', '1', '2015-03-26 14:15:42');
INSERT INTO `core_answer` VALUES ('210', '– CH = O', '54', '0', '2015-03-26 14:16:28');
INSERT INTO `core_answer` VALUES ('211', '–OH', '54', '0', '2015-03-26 14:16:28');
INSERT INTO `core_answer` VALUES ('212', '–COOH', '54', '1', '2015-03-26 14:16:28');
INSERT INTO `core_answer` VALUES ('213', '–CH3', '54', '0', '2015-03-26 14:16:28');
INSERT INTO `core_answer` VALUES ('214', '8,96 lít', '55', '0', '2015-03-26 14:17:11');
INSERT INTO `core_answer` VALUES ('215', '4,48 lít', '55', '0', '2015-03-26 14:17:11');
INSERT INTO `core_answer` VALUES ('216', '2,24 lít', '55', '0', '2015-03-26 14:17:11');
INSERT INTO `core_answer` VALUES ('217', '1,12 lít', '55', '1', '2015-03-26 14:17:11');
INSERT INTO `core_answer` VALUES ('218', 'S', '56', '0', '2015-03-26 14:17:59');
INSERT INTO `core_answer` VALUES ('219', 'Hg', '56', '1', '2015-03-26 14:17:59');
INSERT INTO `core_answer` VALUES ('220', 'Th', '56', '0', '2015-03-26 14:17:59');
INSERT INTO `core_answer` VALUES ('221', 'Fe', '56', '0', '2015-03-26 14:17:59');
INSERT INTO `core_answer` VALUES ('222', 'Na2SO4; CaCO3', '57', '1', '2015-03-26 14:19:07');
INSERT INTO `core_answer` VALUES ('223', 'NaCl; H2NO3', '57', '0', '2015-03-26 14:19:07');
INSERT INTO `core_answer` VALUES ('224', 'FeCl; BaCl2', '57', '0', '2015-03-26 14:19:07');
INSERT INTO `core_answer` VALUES ('225', 'Cả a và c đều đúng', '57', '0', '2015-03-26 14:19:07');
INSERT INTO `core_answer` VALUES ('226', 'Những hành vi sai lệch chuẩn mực xã hội', '58', '0', '2015-03-26 14:21:39');
INSERT INTO `core_answer` VALUES ('227', 'Vi phạm đạo đức và xã hội', '58', '0', '2015-03-26 14:21:39');
INSERT INTO `core_answer` VALUES ('228', 'Gây hậu quả xấu về mọi mặt đối với đời sống xã hội', '58', '0', '2015-03-26 14:21:39');
INSERT INTO `core_answer` VALUES ('229', 'Cả 3 đáp án trên đều đúng', '58', '1', '2015-03-26 14:21:39');
INSERT INTO `core_answer` VALUES ('230', 'A rủ B vào quán chơi điện tử an tiền', '59', '1', '2015-03-26 14:22:43');
INSERT INTO `core_answer` VALUES ('231', 'Không nhận lời người là chuyển gói hàng', '59', '0', '2015-03-26 14:22:43');
INSERT INTO `core_answer` VALUES ('232', 'Nghi ngờ việc mờ án đến báo công an', '59', '0', '2015-03-26 14:22:43');
INSERT INTO `core_answer` VALUES ('233', 'Vận động mọi người không trồng cây thuốc phiện', '59', '0', '2015-03-26 14:22:43');
INSERT INTO `core_answer` VALUES ('234', 'Người mắc tệ nạn xã hội thường lười lao động, thích hưởng thụ', '60', '0', '2015-03-26 14:26:11');
INSERT INTO `core_answer` VALUES ('235', 'Hút thuốc là không có hại vì đó không phải lfa ma túy', '60', '1', '2015-03-26 14:26:11');
INSERT INTO `core_answer` VALUES ('236', 'Tệ nạn xã hội là con đường dẫn đến tội ác', '60', '0', '2015-03-26 14:26:11');
INSERT INTO `core_answer` VALUES ('237', 'Tích cực học tập, lao động sẽ giúp ta tránh được tệ nạn xã hội', '60', '0', '2015-03-26 14:26:11');
INSERT INTO `core_answer` VALUES ('238', 'Truyền máu', '61', '0', '2015-03-26 14:26:55');
INSERT INTO `core_answer` VALUES ('239', 'Từ mẹ sang con', '61', '0', '2015-03-26 14:26:55');
INSERT INTO `core_answer` VALUES ('240', 'Dung chung bát, đĩa', '61', '1', '2015-03-26 14:26:55');
INSERT INTO `core_answer` VALUES ('241', 'Quan hệ tình dục', '61', '0', '2015-03-26 14:26:55');
INSERT INTO `core_answer` VALUES ('242', 'Công an sử dụng vũ khí để trấn áp tội phạm', '62', '0', '2015-03-26 14:27:47');
INSERT INTO `core_answer` VALUES ('243', 'Bộ đội bắn pháp hoa nhân ngày lễ lớn', '62', '0', '2015-03-26 14:27:47');
INSERT INTO `core_answer` VALUES ('244', 'Sản xuất, tang trữ, buôn bán pháo, vũ khí, thuốc nổ', '62', '1', '2015-03-26 14:27:47');
INSERT INTO `core_answer` VALUES ('245', 'Phát hiện bọn buôn pháo lậu đến báo công an', '62', '0', '2015-03-26 14:27:47');
INSERT INTO `core_answer` VALUES ('246', 'Trung thực', '63', '0', '2015-03-26 14:28:32');
INSERT INTO `core_answer` VALUES ('247', 'Thật thà', '63', '0', '2015-03-26 14:28:32');
INSERT INTO `core_answer` VALUES ('248', 'Liêm khiết', '63', '0', '2015-03-26 14:28:32');
INSERT INTO `core_answer` VALUES ('249', 'Tự trọng', '63', '1', '2015-03-26 14:28:32');
INSERT INTO `core_answer` VALUES ('250', 'Biết lắng nghe ý kiến người khác', '64', '1', '2015-03-26 14:29:18');
INSERT INTO `core_answer` VALUES ('251', 'Dùng vũ lực để giải quyết các mâu thuẫn cá nhân', '64', '0', '2015-03-26 14:29:18');
INSERT INTO `core_answer` VALUES ('252', 'Bắt mọi người phải phục tùng ý kiến của mình', '64', '0', '2015-03-26 14:29:18');
INSERT INTO `core_answer` VALUES ('253', 'Phân biệt đối xử giữa các dân tộc, màu da', '64', '0', '2015-03-26 14:29:18');
INSERT INTO `core_answer` VALUES ('254', 'Chỉ có người có chức có quyền mới cần đến chí công vô tư', '65', '0', '2015-03-26 14:30:01');
INSERT INTO `core_answer` VALUES ('255', 'Người sống chí công vô tư chỉ thiệt cho mình', '65', '0', '2015-03-26 14:30:01');
INSERT INTO `core_answer` VALUES ('256', 'Học sinh còn nhỏ không cần phẩm chất chí công vô tư', '65', '0', '2015-03-26 14:30:01');
INSERT INTO `core_answer` VALUES ('257', 'Chí công vo tư thể hiện cả lời nói và việc làm', '65', '1', '2015-03-26 14:30:01');
INSERT INTO `core_answer` VALUES ('258', 'Có hai hay nhiều cụm chủ - vị bao chưa nhau tạo thành', '66', '0', '2015-03-26 14:32:51');
INSERT INTO `core_answer` VALUES ('259', 'Có hai hoặc nhiều cụm chủ - vị không bao chứa nhau tạo thành', '66', '1', '2015-03-26 14:32:51');
INSERT INTO `core_answer` VALUES ('260', 'Có một cụm chủ - vị', '66', '0', '2015-03-26 14:32:51');
INSERT INTO `core_answer` VALUES ('261', 'Có hai hoặc nhiều cụm chủ - vị', '66', '0', '2015-03-26 14:32:51');
INSERT INTO `core_answer` VALUES ('262', 'Từ ngữ được dẫn trực tiếp', '67', '0', '2015-03-26 14:33:28');
INSERT INTO `core_answer` VALUES ('263', 'Từ ngữ được hiểu theo nghĩa đặc biệt', '67', '0', '2015-03-26 14:33:28');
INSERT INTO `core_answer` VALUES ('264', 'Phần chú thích', '67', '0', '2015-03-26 14:33:28');
INSERT INTO `core_answer` VALUES ('265', 'Tên tác phẩm', '67', '1', '2015-03-26 14:33:28');
INSERT INTO `core_answer` VALUES ('266', 'Anh nên hòa nhã với bạn bè', '68', '0', '2015-03-26 14:34:11');
INSERT INTO `core_answer` VALUES ('267', 'Anh không nên ở đây nữa', '68', '0', '2015-03-26 14:34:11');
INSERT INTO `core_answer` VALUES ('268', 'Xin đừng hút thuốc trong phòng', '68', '0', '2015-03-26 14:34:11');
INSERT INTO `core_answer` VALUES ('269', 'Nó nói như thế là ác ý', '68', '1', '2015-03-26 14:34:11');
INSERT INTO `core_answer` VALUES ('270', 'Thét ra lửa', '69', '1', '2015-03-26 14:34:57');
INSERT INTO `core_answer` VALUES ('271', 'Da mồi tóc sương', '69', '0', '2015-03-26 14:34:57');
INSERT INTO `core_answer` VALUES ('272', 'Sinh cơ lập nghiệp', '69', '0', '2015-03-26 14:34:57');
INSERT INTO `core_answer` VALUES ('273', 'Ngày lành tháng tốt', '69', '0', '2015-03-26 14:34:57');
INSERT INTO `core_answer` VALUES ('274', 'Xôn xao', '70', '1', '2015-03-26 14:39:52');
INSERT INTO `core_answer` VALUES ('275', 'Xộc xệch', '70', '0', '2015-03-26 14:39:52');
INSERT INTO `core_answer` VALUES ('276', 'Rũ rượi', '70', '0', '2015-03-26 14:39:52');
INSERT INTO `core_answer` VALUES ('277', 'Xồng xộc', '70', '0', '2015-03-26 14:39:52');
INSERT INTO `core_answer` VALUES ('278', 'Là dung lời văn của mình kẻ lại chi tiết văn bản ấy', '71', '0', '2015-03-26 14:40:43');
INSERT INTO `core_answer` VALUES ('279', 'Là dung lời văn của mình kể về nhân vật chính trong văn bản một cách ngắn gọn', '71', '0', '2015-03-26 14:40:43');
INSERT INTO `core_answer` VALUES ('280', 'Dùng lời văn của mình nói về các yếu tố nghệ thuật tiêu biểu của văn bản một cách ngắn gọn', '71', '0', '2015-03-26 14:40:43');
INSERT INTO `core_answer` VALUES ('281', 'Dùng lời văn của mình ghi lại một cách ngắn gọn, đầy đủ, trung thực nội dung của văn bản cần tóm tắt', '71', '1', '2015-03-26 14:40:43');
INSERT INTO `core_answer` VALUES ('282', 'School', '72', '1', '2015-03-26 14:45:17');
INSERT INTO `core_answer` VALUES ('283', 'Kitchen', '72', '0', '2015-03-26 14:45:17');
INSERT INTO `core_answer` VALUES ('284', 'Chat', '72', '0', '2015-03-26 14:45:17');
INSERT INTO `core_answer` VALUES ('285', 'Choose', '72', '0', '2015-03-26 14:45:17');
INSERT INTO `core_answer` VALUES ('286', 'A', '73', '0', '2015-03-26 14:46:59');
INSERT INTO `core_answer` VALUES ('287', 'B', '73', '0', '2015-03-26 14:46:59');
INSERT INTO `core_answer` VALUES ('288', 'C', '73', '0', '2015-03-26 14:46:59');
INSERT INTO `core_answer` VALUES ('289', 'D', '73', '1', '2015-03-26 14:46:59');
INSERT INTO `core_answer` VALUES ('290', 'A', '74', '0', '2015-03-26 14:47:46');
INSERT INTO `core_answer` VALUES ('291', 'B', '74', '1', '2015-03-26 14:47:46');
INSERT INTO `core_answer` VALUES ('292', 'C', '74', '0', '2015-03-26 14:47:46');
INSERT INTO `core_answer` VALUES ('293', 'D', '74', '0', '2015-03-26 14:47:46');
INSERT INTO `core_answer` VALUES ('294', 'Upset', '75', '0', '2015-03-26 14:48:26');
INSERT INTO `core_answer` VALUES ('295', 'Agree', '75', '0', '2015-03-26 14:48:26');
INSERT INTO `core_answer` VALUES ('296', 'Mobile', '75', '1', '2015-03-26 14:48:26');
INSERT INTO `core_answer` VALUES ('297', 'Enroll', '75', '0', '2015-03-26 14:48:26');
INSERT INTO `core_answer` VALUES ('298', 'To', '76', '0', '2015-03-26 14:49:03');
INSERT INTO `core_answer` VALUES ('299', 'As', '76', '0', '2015-03-26 14:49:03');
INSERT INTO `core_answer` VALUES ('300', 'With', '76', '0', '2015-03-26 14:49:03');
INSERT INTO `core_answer` VALUES ('301', 'From', '76', '1', '2015-03-26 14:49:03');
INSERT INTO `core_answer` VALUES ('302', 'Working', '77', '0', '2015-03-26 14:49:41');
INSERT INTO `core_answer` VALUES ('303', 'Works', '77', '0', '2015-03-26 14:49:41');
INSERT INTO `core_answer` VALUES ('304', 'Has worked', '77', '1', '2015-03-26 14:49:41');
INSERT INTO `core_answer` VALUES ('305', 'Worked', '77', '0', '2015-03-26 14:49:41');
INSERT INTO `core_answer` VALUES ('306', 'Playing / is', '78', '0', '2015-03-26 14:50:26');
INSERT INTO `core_answer` VALUES ('307', 'Play / Was', '78', '1', '2015-03-26 14:50:26');
INSERT INTO `core_answer` VALUES ('308', 'Played / is', '78', '0', '2015-03-26 14:50:26');
INSERT INTO `core_answer` VALUES ('309', 'Plays /was', '78', '0', '2015-03-26 14:50:26');
INSERT INTO `core_answer` VALUES ('310', 'Di truyền', '79', '1', '2015-03-26 14:53:03');
INSERT INTO `core_answer` VALUES ('311', 'Thức ăn', '79', '0', '2015-03-26 14:53:03');
INSERT INTO `core_answer` VALUES ('312', 'Chăm sóc', '79', '0', '2015-03-26 14:53:03');
INSERT INTO `core_answer` VALUES ('313', 'Cả 3 đáp án trên đều đúng', '79', '0', '2015-03-26 14:53:03');
INSERT INTO `core_answer` VALUES ('314', 'Chất khoáng', '80', '0', '2015-03-26 14:53:55');
INSERT INTO `core_answer` VALUES ('315', 'Động vật', '80', '1', '2015-03-26 14:53:55');
INSERT INTO `core_answer` VALUES ('316', 'Thực vật', '80', '0', '2015-03-26 14:53:55');
INSERT INTO `core_answer` VALUES ('317', 'Năng suất và chất lượng sản phẩm vật nuôi', '81', '1', '2015-03-26 14:54:36');
INSERT INTO `core_answer` VALUES ('318', 'Lượng thịt', '81', '0', '2015-03-26 14:54:36');
INSERT INTO `core_answer` VALUES ('319', 'Lượng mỡ', '81', '0', '2015-03-26 14:54:36');
INSERT INTO `core_answer` VALUES ('320', 'Lượng sữa', '81', '0', '2015-03-26 14:54:36');
INSERT INTO `core_answer` VALUES ('321', 'Glyxerin', '82', '0', '2015-03-26 14:55:18');
INSERT INTO `core_answer` VALUES ('322', 'Axit béo', '82', '0', '2015-03-26 14:55:18');
INSERT INTO `core_answer` VALUES ('323', 'Đường đơn', '82', '0', '2015-03-26 14:55:18');
INSERT INTO `core_answer` VALUES ('324', 'Axit amin', '82', '1', '2015-03-26 14:55:18');
INSERT INTO `core_answer` VALUES ('325', 'Đường kính và chu vi đường tròn', '83', '0', '2015-03-26 15:11:08');
INSERT INTO `core_answer` VALUES ('326', 'Chu vi đường tròn và đường kính', '83', '1', '2015-03-26 15:11:08');
INSERT INTO `core_answer` VALUES ('327', 'Đường kính và chu vi hình vuông nội tiếp đường tròn', '83', '0', '2015-03-26 15:11:08');
INSERT INTO `core_answer` VALUES ('328', 'Đường kính và chu vi hình vuông ngoại tiếp đường tròn', '83', '0', '2015-03-26 15:11:08');
INSERT INTO `core_answer` VALUES ('329', 'Đường trung tuyến', '84', '1', '2015-03-26 15:17:37');
INSERT INTO `core_answer` VALUES ('330', 'Đường phân giác', '84', '0', '2015-03-26 15:17:37');
INSERT INTO `core_answer` VALUES ('331', 'Đường cao', '84', '0', '2015-03-26 15:17:37');
INSERT INTO `core_answer` VALUES ('332', 'Đường trung trực', '84', '0', '2015-03-26 15:17:37');
INSERT INTO `core_answer` VALUES ('333', 'Hi lạp', '85', '0', '2015-03-26 15:18:22');
INSERT INTO `core_answer` VALUES ('334', 'Ấn độ', '85', '1', '2015-03-26 15:18:22');
INSERT INTO `core_answer` VALUES ('335', 'Ai cập', '85', '0', '2015-03-26 15:18:22');
INSERT INTO `core_answer` VALUES ('336', 'Việt nam', '85', '0', '2015-03-26 15:18:22');
INSERT INTO `core_answer` VALUES ('337', '38', '86', '1', '2015-03-26 15:19:06');
INSERT INTO `core_answer` VALUES ('338', '312', '86', '0', '2015-03-26 15:19:06');
INSERT INTO `core_answer` VALUES ('339', '98', '86', '0', '2015-03-26 15:19:06');
INSERT INTO `core_answer` VALUES ('340', '912', '86', '0', '2015-03-26 15:19:06');
INSERT INTO `core_answer` VALUES ('341', '25g', '87', '0', '2015-03-26 15:20:44');
INSERT INTO `core_answer` VALUES ('342', '64 g', '87', '1', '2015-03-26 15:20:44');
INSERT INTO `core_answer` VALUES ('343', '200g', '87', '0', '2015-03-26 15:20:44');
INSERT INTO `core_answer` VALUES ('344', '320g', '87', '0', '2015-03-26 15:20:44');
INSERT INTO `core_answer` VALUES ('345', 'A (-1;-2)', '88', '1', '2015-03-26 15:21:45');
INSERT INTO `core_answer` VALUES ('346', 'B (0;0)', '88', '1', '2015-03-26 15:21:45');
INSERT INTO `core_answer` VALUES ('347', 'C (2;4)', '88', '1', '2015-03-26 15:21:45');
INSERT INTO `core_answer` VALUES ('348', 'Cả 3 đáp án trên đều sai', '88', '0', '2015-03-26 15:21:45');
INSERT INTO `core_answer` VALUES ('349', 'D đi qua trung điểm của AB', '89', '0', '2015-03-26 15:23:45');
INSERT INTO `core_answer` VALUES ('350', 'D vuông góc với AB', '89', '0', '2015-03-26 15:23:45');
INSERT INTO `core_answer` VALUES ('351', 'D vuông góc tại trung điểm của AB', '89', '1', '2015-03-26 15:23:45');
INSERT INTO `core_answer` VALUES ('352', 'Cả 3 đáp án đều đúng', '89', '0', '2015-03-26 15:23:45');
INSERT INTO `core_answer` VALUES ('353', 'B + C = 100o', '90', '0', '2015-03-26 15:25:16');
INSERT INTO `core_answer` VALUES ('354', 'B+ C = 180o', '90', '0', '2015-03-26 15:25:16');
INSERT INTO `core_answer` VALUES ('355', 'B+ C = 90o', '90', '1', '2015-03-26 15:25:16');
INSERT INTO `core_answer` VALUES ('356', 'B+ C = 80o', '90', '0', '2015-03-26 15:25:16');
INSERT INTO `core_answer` VALUES ('357', 'Là khả năng của cơ thể chống lại mệt mỏi khi học tập, lao động hay tập luyện TDTT kéo dài', '91', '1', '2015-03-26 15:37:36');
INSERT INTO `core_answer` VALUES ('358', 'Là khả năng của cơ thể thực hiện 1 động tác trong thời gian ngắn nhất', '91', '0', '2015-03-26 15:37:36');
INSERT INTO `core_answer` VALUES ('359', 'Là khả năng mà con người thực hiện song những bài tập', '91', '0', '2015-03-26 15:37:36');
INSERT INTO `core_answer` VALUES ('360', 'Là sự kéo dài sức lực của cơ thể trong thời gian lâu nhất', '91', '0', '2015-03-26 15:37:36');
INSERT INTO `core_answer` VALUES ('361', 'Tập từ đơn giản đến phức tạp', '92', '0', '2015-03-26 15:39:30');
INSERT INTO `core_answer` VALUES ('362', 'Khởi động kĩ trước khi tập luyện', '92', '0', '2015-03-26 15:39:30');
INSERT INTO `core_answer` VALUES ('363', 'Tuân thủ những quy định một cách nghiêm túc', '92', '0', '2015-03-26 15:39:30');
INSERT INTO `core_answer` VALUES ('364', 'Tập các động tác khó, nguy hiểm khi không có người hướng dẫn', '92', '1', '2015-03-26 15:39:30');
INSERT INTO `core_answer` VALUES ('365', 'Ăn nhẹ, uống nhẹ', '93', '1', '2015-03-26 15:40:43');
INSERT INTO `core_answer` VALUES ('366', 'Ăn no và uống nhẹ', '93', '0', '2015-03-26 15:40:43');
INSERT INTO `core_answer` VALUES ('367', 'Ăn nhẹ, uống nhiều', '93', '0', '2015-03-26 15:40:43');
INSERT INTO `core_answer` VALUES ('368', 'Ăn nhiều, uống nhiều', '93', '0', '2015-03-26 15:40:43');
INSERT INTO `core_answer` VALUES ('369', 'Ngồi hoặc nằm ngay', '94', '0', '2015-03-26 15:42:44');
INSERT INTO `core_answer` VALUES ('370', 'Báo cáo cho giáo viên biết', '94', '1', '2015-03-26 15:42:44');
INSERT INTO `core_answer` VALUES ('371', 'Không cần báo cho giáo viên biết và vẫn duy trì tập luyện', '94', '0', '2015-03-26 15:42:44');
INSERT INTO `core_answer` VALUES ('372', 'Tập giảm nhẹ động tác', '94', '0', '2015-03-26 15:42:44');
INSERT INTO `core_answer` VALUES ('373', 'Dừng lại', '95', '0', '2015-03-26 15:44:00');
INSERT INTO `core_answer` VALUES ('374', 'Dừng lại ... dừng', '95', '0', '2015-03-26 15:44:00');
INSERT INTO `core_answer` VALUES ('375', 'Đứng lại ... đứng', '95', '1', '2015-03-26 15:44:00');
INSERT INTO `core_answer` VALUES ('376', 'Dừng lại ... đứng', '95', '0', '2015-03-26 15:44:00');
INSERT INTO `core_answer` VALUES ('377', 'Điền kinh', '96', '0', '2015-03-26 15:48:21');
INSERT INTO `core_answer` VALUES ('378', 'Bóng chuyền', '96', '0', '2015-03-26 15:48:21');
INSERT INTO `core_answer` VALUES ('379', 'Bóng đá', '96', '1', '2015-03-26 15:48:21');
INSERT INTO `core_answer` VALUES ('380', 'Bơi lội', '96', '0', '2015-03-26 15:48:21');
INSERT INTO `core_answer` VALUES ('381', '28', '97', '0', '2015-03-26 15:49:12');
INSERT INTO `core_answer` VALUES ('382', '30', '97', '0', '2015-03-26 15:49:12');
INSERT INTO `core_answer` VALUES ('383', '32', '97', '1', '2015-03-26 15:49:12');
INSERT INTO `core_answer` VALUES ('384', '34', '97', '0', '2015-03-26 15:49:12');
INSERT INTO `core_answer` VALUES ('385', 'Học bài thể dục', '98', '0', '2015-03-26 15:50:20');
INSERT INTO `core_answer` VALUES ('386', 'Khởi động', '98', '1', '2015-03-26 15:50:20');
INSERT INTO `core_answer` VALUES ('387', 'Chạy nhanh', '98', '0', '2015-03-26 15:50:20');
INSERT INTO `core_answer` VALUES ('388', 'Đội hình đôi ngũ', '98', '0', '2015-03-26 15:50:20');
INSERT INTO `core_answer` VALUES ('389', '4', '99', '0', '2015-03-26 15:51:00');
INSERT INTO `core_answer` VALUES ('390', '5', '99', '0', '2015-03-26 15:51:00');
INSERT INTO `core_answer` VALUES ('391', '6', '99', '1', '2015-03-26 15:51:00');
INSERT INTO `core_answer` VALUES ('392', '7', '99', '0', '2015-03-26 15:51:00');
INSERT INTO `core_answer` VALUES ('393', '1', '100', '0', '2015-03-26 15:51:40');
INSERT INTO `core_answer` VALUES ('394', '2', '100', '1', '2015-03-26 15:51:40');
INSERT INTO `core_answer` VALUES ('395', '3', '100', '0', '2015-03-26 15:51:40');
INSERT INTO `core_answer` VALUES ('396', '4', '100', '0', '2015-03-26 15:51:40');
INSERT INTO `core_answer` VALUES ('397', 'Bơi lội', '101', '0', '2015-03-26 15:52:32');
INSERT INTO `core_answer` VALUES ('398', 'Cờ vua', '101', '0', '2015-03-26 15:52:32');
INSERT INTO `core_answer` VALUES ('399', 'Võ thuật', '101', '0', '2015-03-26 15:52:32');
INSERT INTO `core_answer` VALUES ('400', 'Điền kinh', '101', '1', '2015-03-26 15:52:32');
INSERT INTO `core_answer` VALUES ('401', 'Bóng đá', '102', '0', '2015-03-26 15:53:46');
INSERT INTO `core_answer` VALUES ('402', 'Vật', '102', '1', '2015-03-26 15:53:46');
INSERT INTO `core_answer` VALUES ('403', 'Bóng chuyền', '102', '0', '2015-03-26 15:53:46');
INSERT INTO `core_answer` VALUES ('404', 'Cầu lông', '102', '0', '2015-03-26 15:53:46');
INSERT INTO `core_answer` VALUES ('409', 'Sưởi ấm', '105', '1', '2015-03-30 16:24:56');
INSERT INTO `core_answer` VALUES ('410', 'Nấu chín thức ăn', '105', '1', '2015-03-30 16:24:56');
INSERT INTO `core_answer` VALUES ('411', 'Xua đuổi thú dữ', '105', '1', '2015-03-30 16:24:56');
INSERT INTO `core_answer` VALUES ('412', 'Cả 3 đáp án trên đều sai', '105', '0', '2015-03-30 16:24:56');
INSERT INTO `core_answer` VALUES ('413', 'Thể\r\nhiện sức mạnh của đất nước&nbsp;', '106', '0', '2015-03-30 16:28:46');
INSERT INTO `core_answer` VALUES ('414', 'Thể\r\nhiện sức mạnh của thần thánh', '106', '0', '2015-03-30 16:28:46');
INSERT INTO `core_answer` VALUES ('415', 'Thể hiện sức mạnh và uy quyền của nhà vua', '106', '1', '2015-03-30 16:28:46');
INSERT INTO `core_answer` VALUES ('416', 'Thể\r\nhiện tình đoàn kết dân tộc', '106', '0', '2015-03-30 16:28:46');
INSERT INTO `core_answer` VALUES ('417', 'Vịnh Hạ Long', '107', '0', '2015-03-30 16:29:45');
INSERT INTO `core_answer` VALUES ('418', 'Phong Nha', '107', '0', '2015-03-30 16:29:45');
INSERT INTO `core_answer` VALUES ('419', 'Thánh địa Mỹ Sơn', '107', '0', '2015-03-30 16:29:45');
INSERT INTO `core_answer` VALUES ('420', 'Núi Phanxipang', '107', '1', '2015-03-30 16:29:45');
INSERT INTO `core_answer` VALUES ('421', 'TAM', '108', '0', '2015-03-30 16:30:28');
INSERT INTO `core_answer` VALUES ('422', 'ATM', '108', '0', '2015-03-30 16:30:28');
INSERT INTO `core_answer` VALUES ('423', 'GMT', '108', '1', '2015-03-30 16:30:28');
INSERT INTO `core_answer` VALUES ('424', 'GTM', '108', '0', '2015-03-30 16:30:28');
INSERT INTO `core_answer` VALUES ('425', 'Đường kính và chu vi đường tròn', '109', '0', '2015-03-30 16:31:49');
INSERT INTO `core_answer` VALUES ('426', '&nbsp;Chu vi đường tròn và đường kính', '109', '1', '2015-03-30 16:31:49');
INSERT INTO `core_answer` VALUES ('427', 'Đường kính và chu vi hình vuông nội tiếp đường tròn', '109', '0', '2015-03-30 16:31:49');
INSERT INTO `core_answer` VALUES ('428', '&nbsp;Đường kính và chu vi hình vuông ngoại tiếp đường tròn', '109', '0', '2015-03-30 16:31:49');
INSERT INTO `core_answer` VALUES ('429', 'Đường trung tuyến', '110', '1', '2015-03-30 16:32:35');
INSERT INTO `core_answer` VALUES ('430', 'Đường phân giác', '110', '0', '2015-03-30 16:32:35');
INSERT INTO `core_answer` VALUES ('431', 'Đường cao', '110', '0', '2015-03-30 16:32:35');
INSERT INTO `core_answer` VALUES ('432', 'Đường trung trực', '110', '0', '2015-03-30 16:32:35');
INSERT INTO `core_answer` VALUES ('433', 'Hi lạp', '111', '0', '2015-03-30 16:33:18');
INSERT INTO `core_answer` VALUES ('434', 'Ấn độ', '111', '1', '2015-03-30 16:33:18');
INSERT INTO `core_answer` VALUES ('435', 'Ai cập', '111', '0', '2015-03-30 16:33:18');
INSERT INTO `core_answer` VALUES ('436', 'Việt nam', '111', '0', '2015-03-30 16:33:18');
INSERT INTO `core_answer` VALUES ('437', 'Oxi', '112', '0', '2015-03-30 16:35:06');
INSERT INTO `core_answer` VALUES ('438', 'Nito', '112', '0', '2015-03-30 16:35:06');
INSERT INTO `core_answer` VALUES ('439', 'Hidro', '112', '1', '2015-03-30 16:35:06');
INSERT INTO `core_answer` VALUES ('440', 'Cácbon', '112', '0', '2015-03-30 16:35:06');
INSERT INTO `core_answer` VALUES ('441', 'Lutetium', '113', '0', '2015-03-30 16:35:54');
INSERT INTO `core_answer` VALUES ('442', 'Vàng', '113', '1', '2015-03-30 16:35:54');
INSERT INTO `core_answer` VALUES ('443', 'Nhôm', '113', '0', '2015-03-30 16:35:54');
INSERT INTO `core_answer` VALUES ('444', 'Lithium', '113', '0', '2015-03-30 16:35:54');
INSERT INTO `core_answer` VALUES ('445', 'Con cái và con đực chung sống cùng nhau', '114', '0', '2015-03-30 16:37:04');
INSERT INTO `core_answer` VALUES ('446', 'Con đực ăn con cái', '114', '0', '2015-03-30 16:37:04');
INSERT INTO `core_answer` VALUES ('447', 'Con cái ăn con đực', '114', '1', '2015-03-30 16:37:04');
INSERT INTO `core_answer` VALUES ('448', 'Cả 3 đáp án trên đều sai', '114', '0', '2015-03-30 16:37:04');
INSERT INTO `core_answer` VALUES ('449', '0,25 lít', '115', '0', '2015-03-30 16:38:29');
INSERT INTO `core_answer` VALUES ('450', '0,5 lít', '115', '0', '2015-03-30 16:38:29');
INSERT INTO `core_answer` VALUES ('451', '1 lít', '115', '1', '2015-03-30 16:38:29');
INSERT INTO `core_answer` VALUES ('452', '1,5 lít', '115', '0', '2015-03-30 16:38:29');
INSERT INTO `core_answer` VALUES ('453', 'Copernic', '116', '0', '2015-03-30 16:39:19');
INSERT INTO `core_answer` VALUES ('454', 'Aristote', '116', '1', '2015-03-30 16:39:19');
INSERT INTO `core_answer` VALUES ('455', 'Magellen', '116', '0', '2015-03-30 16:39:19');
INSERT INTO `core_answer` VALUES ('456', 'Galileo', '116', '0', '2015-03-30 16:39:19');
INSERT INTO `core_answer` VALUES ('457', 'Thủy tinh, 2', '117', '0', '2015-03-30 16:41:48');
INSERT INTO `core_answer` VALUES ('458', 'Kim tinh, 1', '117', '0', '2015-03-30 16:41:48');
INSERT INTO `core_answer` VALUES ('459', '&nbsp;Thủy tinh, 1', '117', '0', '2015-03-30 16:41:48');
INSERT INTO `core_answer` VALUES ('460', 'Kim tinh, 2', '117', '1', '2015-03-30 16:41:48');
INSERT INTO `core_answer` VALUES ('461', 'Áo', '118', '1', '2015-03-30 16:43:07');
INSERT INTO `core_answer` VALUES ('462', 'Anh', '118', '0', '2015-03-30 16:43:07');
INSERT INTO `core_answer` VALUES ('463', 'Pháp', '118', '0', '2015-03-30 16:43:07');
INSERT INTO `core_answer` VALUES ('464', 'Italia', '118', '0', '2015-03-30 16:43:07');
INSERT INTO `core_answer` VALUES ('465', '1825', '119', '0', '2015-03-30 16:44:01');
INSERT INTO `core_answer` VALUES ('466', '1852', '119', '0', '2015-03-30 16:44:01');
INSERT INTO `core_answer` VALUES ('467', '1925', '119', '1', '2015-03-30 16:44:01');
INSERT INTO `core_answer` VALUES ('468', '1952', '119', '0', '2015-03-30 16:44:01');
INSERT INTO `core_answer` VALUES ('469', 'Màu bột', '120', '0', '2015-03-30 16:45:51');
INSERT INTO `core_answer` VALUES ('470', 'Sơn dầu', '120', '1', '2015-03-30 16:45:51');
INSERT INTO `core_answer` VALUES ('471', 'Lụa', '120', '0', '2015-03-30 16:45:51');
INSERT INTO `core_answer` VALUES ('472', 'Sơn mài', '120', '0', '2015-03-30 16:45:51');
INSERT INTO `core_answer` VALUES ('473', 'Di truyền', '121', '1', '2015-03-30 16:46:59');
INSERT INTO `core_answer` VALUES ('474', 'Thức ăn', '121', '1', '2015-03-30 16:46:59');
INSERT INTO `core_answer` VALUES ('475', 'Chăm sóc', '121', '1', '2015-03-30 16:46:59');
INSERT INTO `core_answer` VALUES ('476', 'Cả 3 đáp án đều sai', '121', '0', '2015-03-30 16:46:59');
INSERT INTO `core_answer` VALUES ('477', 'Những hành vi sai lệch chuẩn mực xã hội', '122', '0', '2015-03-30 16:48:35');
INSERT INTO `core_answer` VALUES ('478', 'Vi phạm đạo đức và xã hội', '122', '0', '2015-03-30 16:48:35');
INSERT INTO `core_answer` VALUES ('479', 'Gây hậu quả xấu về mọi mặt đối với đời sống xã hội', '122', '0', '2015-03-30 16:48:35');
INSERT INTO `core_answer` VALUES ('480', 'Cả 3 đáp án trên đều đúng', '122', '1', '2015-03-30 16:48:35');
INSERT INTO `core_answer` VALUES ('481', 'Truyền máu', '123', '0', '2015-03-30 16:51:12');
INSERT INTO `core_answer` VALUES ('482', 'Từ mẹ sang con', '123', '0', '2015-03-30 16:51:12');
INSERT INTO `core_answer` VALUES ('483', 'Dùng chung bát, đĩa', '123', '1', '2015-03-30 16:51:12');
INSERT INTO `core_answer` VALUES ('484', 'Quan hệ tình dục', '123', '0', '2015-03-30 16:51:12');
INSERT INTO `core_answer` VALUES ('485', '.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anh nên hòa nhã với bạn bèb', '124', '0', '2015-03-30 16:52:37');
INSERT INTO `core_answer` VALUES ('486', '.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anh không nên ở đây nữa', '124', '0', '2015-03-30 16:52:37');
INSERT INTO `core_answer` VALUES ('487', 'c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Xin đừng hút thuốc trong phòng', '124', '0', '2015-03-30 16:52:37');
INSERT INTO `core_answer` VALUES ('488', 'Nó nói như thế là ác ý', '124', '1', '2015-03-30 16:52:37');
INSERT INTO `core_answer` VALUES ('489', 'Thét ra lửa', '125', '1', '2015-03-30 16:53:36');
INSERT INTO `core_answer` VALUES ('490', 'Da mồi tóc sương', '125', '0', '2015-03-30 16:53:36');
INSERT INTO `core_answer` VALUES ('491', 'Sinh cơ lập nghiệp', '125', '0', '2015-03-30 16:53:36');
INSERT INTO `core_answer` VALUES ('492', 'Ngày lành tháng tốt', '125', '0', '2015-03-30 16:53:36');
INSERT INTO `core_answer` VALUES ('493', 'a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Xôn xao', '126', '1', '2015-03-30 16:55:05');
INSERT INTO `core_answer` VALUES ('494', 'b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Xộc xệch', '126', '0', '2015-03-30 16:55:05');
INSERT INTO `core_answer` VALUES ('495', 'c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rũ rượid', '126', '0', '2015-03-30 16:55:05');
INSERT INTO `core_answer` VALUES ('496', '.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Xồng xộc', '126', '0', '2015-03-30 16:55:05');
INSERT INTO `core_answer` VALUES ('497', 'Tổ hợp phím CTRL +L', '127', '0', '2015-03-30 16:56:02');
INSERT INTO `core_answer` VALUES ('498', 'Tổ hợp phím CTRL +R', '127', '1', '2015-03-30 16:56:02');
INSERT INTO `core_answer` VALUES ('499', 'Tổ hợp phím CTRL +J', '127', '0', '2015-03-30 16:56:02');
INSERT INTO `core_answer` VALUES ('500', 'Tổ hợp phím CTRL +E', '127', '0', '2015-03-30 16:56:02');
INSERT INTO `core_answer` VALUES ('501', 'CTRL + Z', '128', '1', '2015-03-30 16:57:13');
INSERT INTO `core_answer` VALUES ('502', 'CTRL + C', '128', '0', '2015-03-30 16:57:13');
INSERT INTO `core_answer` VALUES ('503', 'CTRL + X', '128', '0', '2015-03-30 16:57:13');
INSERT INTO `core_answer` VALUES ('504', 'CTRL + V', '128', '0', '2015-03-30 16:57:13');
INSERT INTO `core_answer` VALUES ('505', '&nbsp; &nbsp;&nbsp;To', '129', '0', '2015-03-30 16:58:20');
INSERT INTO `core_answer` VALUES ('506', '&nbsp;As', '129', '0', '2015-03-30 16:58:20');
INSERT INTO `core_answer` VALUES ('507', '&nbsp; &nbsp;With', '129', '0', '2015-03-30 16:58:20');
INSERT INTO `core_answer` VALUES ('508', '&nbsp;&nbsp;From', '129', '1', '2015-03-30 16:58:20');
INSERT INTO `core_answer` VALUES ('509', 'Playing / is', '130', '0', '2015-03-30 16:59:14');
INSERT INTO `core_answer` VALUES ('510', 'Play / Was', '130', '1', '2015-03-30 16:59:14');
INSERT INTO `core_answer` VALUES ('511', 'Played / is', '130', '0', '2015-03-30 16:59:14');
INSERT INTO `core_answer` VALUES ('512', 'Plays /was', '130', '0', '2015-03-30 16:59:14');
INSERT INTO `core_answer` VALUES ('513', 'Không phải dạng vừa đâu', '131', '1', '2015-03-30 17:46:49');
INSERT INTO `core_answer` VALUES ('514', 'Trưa vắng', '131', '0', '2015-03-30 17:46:49');
INSERT INTO `core_answer` VALUES ('515', 'Giấc mơ trưa', '131', '0', '2015-03-30 17:46:49');
INSERT INTO `core_answer` VALUES ('516', 'Họa mi tóc nâu', '131', '0', '2015-03-30 17:46:49');
INSERT INTO `core_answer` VALUES ('517', 'Không phải dạng vừa đâu', '132', '1', '2015-03-30 18:24:15');
INSERT INTO `core_answer` VALUES ('518', '123', '132', '0', '2015-03-30 18:24:15');
INSERT INTO `core_answer` VALUES ('519', 'Tiếng gà trưa', '132', '0', '2015-03-30 18:24:15');
INSERT INTO `core_answer` VALUES ('523', 'ge', '133', '0', '2015-05-06 09:51:25');
INSERT INTO `core_answer` VALUES ('524', 'vẻ', '133', '0', '2015-05-06 09:51:25');
INSERT INTO `core_answer` VALUES ('525', 'be', '133', '1', '2015-05-06 09:51:25');
INSERT INTO `core_answer` VALUES ('526', 'grew', '134', '0', '2015-05-06 10:11:17');
INSERT INTO `core_answer` VALUES ('527', 'rtww', '134', '0', '2015-05-06 10:11:17');
INSERT INTO `core_answer` VALUES ('528', 'htrwe4', '134', '0', '2015-05-06 10:11:17');
INSERT INTO `core_answer` VALUES ('529', '12345', '134', '1', '2015-05-06 10:11:17');
INSERT INTO `core_answer` VALUES ('534', 'Bút viết', '135', '0', '2015-05-06 10:57:49');
INSERT INTO `core_answer` VALUES ('535', 'Bảng viết', '135', '0', '2015-05-06 10:57:49');
INSERT INTO `core_answer` VALUES ('536', 'Tương tác', '135', '1', '2015-05-06 10:57:49');
INSERT INTO `core_answer` VALUES ('537', 'Học bài', '135', '0', '2015-05-06 10:57:49');
INSERT INTO `core_answer` VALUES ('538', 'sfd', '136', '0', '2015-05-14 18:36:37');
INSERT INTO `core_answer` VALUES ('539', '<p>v<img src=\"http://localhost/Quiz/public/uploads/uploadify/2015-05-14/14555488bb17239be lam banh.jpg\" [removed] 600px;\"></p>', '136', '1', '2015-05-14 18:36:37');
INSERT INTO `core_answer` VALUES ('540', '<p>kahwi</p>&lt;audio controls=\"\" src=\"http://localhost/Quiz/public/uploads/uploadify/2015-05-14/1455548e8adb41dSay You Do - Tien Tien [MP3 128kbps].mp3\" width=\"640\" height=\"360\" frameborder=\"0\"&gt;&lt;/audio>', '137', '1', '2015-05-14 19:05:09');
INSERT INTO `core_answer` VALUES ('541', '12', '138', '1', '2015-06-23 17:48:53');
INSERT INTO `core_answer` VALUES ('542', 'A', '139', '1', '2015-06-23 17:57:16');

-- ----------------------------
-- Table structure for core_category
-- ----------------------------
DROP TABLE IF EXISTS `core_category`;
CREATE TABLE `core_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_level` tinyint(5) NOT NULL DEFAULT '0',
  `category_left` int(11) NOT NULL,
  `category_right` int(11) NOT NULL,
  `category_date_created` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_category
-- ----------------------------

-- ----------------------------
-- Table structure for core_chapter
-- ----------------------------
DROP TABLE IF EXISTS `core_chapter`;
CREATE TABLE `core_chapter` (
  `chapter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chapter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chapter_subject` int(11) unsigned NOT NULL DEFAULT '0',
  `chapter_order` tinyint(1) DEFAULT '0',
  `chapter_status` tinyint(1) NOT NULL DEFAULT '0',
  `chapter_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`chapter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_chapter
-- ----------------------------
INSERT INTO `core_chapter` VALUES ('1', 'Chương I', '2', '0', '1', '2014-12-20 06:48:04');
INSERT INTO `core_chapter` VALUES ('2', 'Chương 2', '2', '0', '1', '2015-03-07 16:33:43');
INSERT INTO `core_chapter` VALUES ('3', 'Chương 3', '2', '0', '1', '2015-03-07 16:33:53');
INSERT INTO `core_chapter` VALUES ('4', 'a', '8', '1', '1', '2015-03-18 19:17:05');
INSERT INTO `core_chapter` VALUES ('5', 'b', '8', '2', '1', '2015-03-18 19:17:13');
INSERT INTO `core_chapter` VALUES ('6', 'c', '8', '3', '1', '2015-03-18 19:17:20');
INSERT INTO `core_chapter` VALUES ('7', 'a', '7', '1', '1', '2015-03-18 19:18:45');
INSERT INTO `core_chapter` VALUES ('8', 'b', '7', '2', '1', '2015-03-18 19:18:54');
INSERT INTO `core_chapter` VALUES ('9', 'a', '9', '0', '1', '2015-03-25 14:46:03');
INSERT INTO `core_chapter` VALUES ('10', 'a', '10', '0', '1', '2015-03-25 14:46:18');
INSERT INTO `core_chapter` VALUES ('11', 'a', '11', '0', '1', '2015-03-25 14:46:30');
INSERT INTO `core_chapter` VALUES ('12', 'a', '12', '0', '1', '2015-03-25 14:46:40');
INSERT INTO `core_chapter` VALUES ('13', 'a', '13', '0', '1', '2015-03-25 14:46:59');
INSERT INTO `core_chapter` VALUES ('14', 'a', '14', '0', '1', '2015-03-25 14:47:11');
INSERT INTO `core_chapter` VALUES ('15', 'a', '15', '0', '1', '2015-03-25 14:47:21');
INSERT INTO `core_chapter` VALUES ('16', 'a', '16', '0', '1', '2015-03-25 14:47:49');
INSERT INTO `core_chapter` VALUES ('17', 'a', '17', '0', '1', '2015-03-25 14:48:11');
INSERT INTO `core_chapter` VALUES ('18', 'a', '18', '0', '1', '2015-03-25 14:48:22');
INSERT INTO `core_chapter` VALUES ('19', 'a', '19', '0', '1', '2015-03-25 14:48:45');
INSERT INTO `core_chapter` VALUES ('20', 'a', '20', '0', '1', '2015-03-25 14:48:55');
INSERT INTO `core_chapter` VALUES ('21', 'a', '21', '0', '1', '2015-03-25 14:49:10');
INSERT INTO `core_chapter` VALUES ('22', '1', '22', '1', '1', '2015-03-30 16:21:56');
INSERT INTO `core_chapter` VALUES ('23', 'ta', '23', '1', '1', '2015-03-30 17:18:44');
INSERT INTO `core_chapter` VALUES ('24', 'Hình ảnh', '24', '1', '1', '2015-03-30 17:42:39');
INSERT INTO `core_chapter` VALUES ('25', 'Âm thanh', '24', '2', '1', '2015-03-30 17:42:50');
INSERT INTO `core_chapter` VALUES ('26', 'C1', '25', '1', '1', '2015-03-30 18:22:43');
INSERT INTO `core_chapter` VALUES ('27', 'tư', '23', '2', '1', '2015-05-06 10:04:22');
INSERT INTO `core_chapter` VALUES ('28', 'Nốt nhạc', '24', '3', '1', '2015-05-06 10:55:19');

-- ----------------------------
-- Table structure for core_classes
-- ----------------------------
DROP TABLE IF EXISTS `core_classes`;
CREATE TABLE `core_classes` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_department` int(11) DEFAULT '0',
  `class_teacher` int(11) DEFAULT '0',
  `class_period` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_status` tinyint(1) NOT NULL DEFAULT '1',
  `class_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_code_index` (`class_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_classes
-- ----------------------------
INSERT INTO `core_classes` VALUES ('1', 'K45', 'CL001', '1', '2', '2010-2014', '1', '2014-06-11 00:00:00');
INSERT INTO `core_classes` VALUES ('2', 'Điện - Tự Động Hóa', 'DIEN-TUDONGHOA', '1', '2', '2012-2016', '1', '2014-10-25 11:07:38');
INSERT INTO `core_classes` VALUES ('3', 'Toán 1', 'T1', '5', '3', '2014-2018', '1', '2015-03-18 19:06:50');
INSERT INTO `core_classes` VALUES ('4', 'QA', 'QA', '7', '5', '1-1', '1', '2015-03-25 16:27:07');
INSERT INTO `core_classes` VALUES ('5', 'Lớp Demo', 'LD', '10', '21', '2011-2015', '1', '2015-03-30 17:49:30');
INSERT INTO `core_classes` VALUES ('6', 'TA1', 'TA1', '11', '22', '2014-2018', '1', '2015-03-30 18:08:17');
INSERT INTO `core_classes` VALUES ('7', 'kl', 'kl', '8', '25', '2011-2015', '1', '2015-05-06 09:22:52');
INSERT INTO `core_classes` VALUES ('8', 'Hoa hồng', 'MN', '9', '26', '2015-2016', '1', '2015-05-06 10:47:58');

-- ----------------------------
-- Table structure for core_configuration
-- ----------------------------
DROP TABLE IF EXISTS `core_configuration`;
CREATE TABLE `core_configuration` (
  `cfg_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `cfg_name` varchar(255) NOT NULL DEFAULT '',
  `cfg_value` longtext NOT NULL,
  PRIMARY KEY (`cfg_id`),
  UNIQUE KEY `cfg_name_index` (`cfg_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_configuration
-- ----------------------------
INSERT INTO `core_configuration` VALUES ('1', 'site_url', 'http://localhost/Quiz/public');

-- ----------------------------
-- Table structure for core_controller
-- ----------------------------
DROP TABLE IF EXISTS `core_controller`;
CREATE TABLE `core_controller` (
  `controller_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `controller_name` varchar(255) NOT NULL,
  `controller_code` varchar(50) NOT NULL,
  `controller_description` text,
  `controller_order` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`controller_id`,`controller_code`),
  KEY `controller_code_index` (`controller_code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_controller
-- ----------------------------
INSERT INTO `core_controller` VALUES ('1', 'Teacher', 'teacher', null, '7');
INSERT INTO `core_controller` VALUES ('2', 'Student', 'student', null, '6');
INSERT INTO `core_controller` VALUES ('3', 'Class', 'classes', null, '3');
INSERT INTO `core_controller` VALUES ('4', 'Department', 'department', null, '4');
INSERT INTO `core_controller` VALUES ('5', 'Subject', 'subject', null, '5');
INSERT INTO `core_controller` VALUES ('6', 'User', 'user', null, '8');
INSERT INTO `core_controller` VALUES ('7', 'Role', 'role', null, '9');
INSERT INTO `core_controller` VALUES ('8', 'Exam', 'exam', null, '1');
INSERT INTO `core_controller` VALUES ('9', 'Question', 'question', null, '2');

-- ----------------------------
-- Table structure for core_country
-- ----------------------------
DROP TABLE IF EXISTS `core_country`;
CREATE TABLE `core_country` (
  `country_code` char(3) NOT NULL DEFAULT '',
  `country_name` char(52) NOT NULL DEFAULT '',
  `country_code2` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`country_code`),
  UNIQUE KEY `country_code_index` (`country_code`),
  UNIQUE KEY `country_code2_index` (`country_code2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of core_country
-- ----------------------------
INSERT INTO `core_country` VALUES ('ABW', 'Aruba', 'AW');
INSERT INTO `core_country` VALUES ('AFG', 'Afghanistan', 'AF');
INSERT INTO `core_country` VALUES ('AGO', 'Angola', 'AO');
INSERT INTO `core_country` VALUES ('AIA', 'Anguilla', 'AI');
INSERT INTO `core_country` VALUES ('ALB', 'Albania', 'AL');
INSERT INTO `core_country` VALUES ('AND', 'Andorra', 'AD');
INSERT INTO `core_country` VALUES ('ANT', 'Netherlands Antilles', 'AN');
INSERT INTO `core_country` VALUES ('ARE', 'United Arab Emirates', 'AE');
INSERT INTO `core_country` VALUES ('ARG', 'Argentina', 'AR');
INSERT INTO `core_country` VALUES ('ARM', 'Armenia', 'AM');
INSERT INTO `core_country` VALUES ('ASM', 'American Samoa', 'AS');
INSERT INTO `core_country` VALUES ('ATA', 'Antarctica', 'AQ');
INSERT INTO `core_country` VALUES ('ATF', 'French Southern territories', 'TF');
INSERT INTO `core_country` VALUES ('ATG', 'Antigua and Barbuda', 'AG');
INSERT INTO `core_country` VALUES ('AUS', 'Australia', 'AU');
INSERT INTO `core_country` VALUES ('AUT', 'Austria', 'AT');
INSERT INTO `core_country` VALUES ('AZE', 'Azerbaijan', 'AZ');
INSERT INTO `core_country` VALUES ('BDI', 'Burundi', 'BI');
INSERT INTO `core_country` VALUES ('BEL', 'Belgium', 'BE');
INSERT INTO `core_country` VALUES ('BEN', 'Benin', 'BJ');
INSERT INTO `core_country` VALUES ('BFA', 'Burkina Faso', 'BF');
INSERT INTO `core_country` VALUES ('BGD', 'Bangladesh', 'BD');
INSERT INTO `core_country` VALUES ('BGR', 'Bulgaria', 'BG');
INSERT INTO `core_country` VALUES ('BHR', 'Bahrain', 'BH');
INSERT INTO `core_country` VALUES ('BHS', 'Bahamas', 'BS');
INSERT INTO `core_country` VALUES ('BIH', 'Bosnia and Herzegovina', 'BA');
INSERT INTO `core_country` VALUES ('BLR', 'Belarus', 'BY');
INSERT INTO `core_country` VALUES ('BLZ', 'Belize', 'BZ');
INSERT INTO `core_country` VALUES ('BMU', 'Bermuda', 'BM');
INSERT INTO `core_country` VALUES ('BOL', 'Bolivia', 'BO');
INSERT INTO `core_country` VALUES ('BRA', 'Brazil', 'BR');
INSERT INTO `core_country` VALUES ('BRB', 'Barbados', 'BB');
INSERT INTO `core_country` VALUES ('BRN', 'Brunei', 'BN');
INSERT INTO `core_country` VALUES ('BTN', 'Bhutan', 'BT');
INSERT INTO `core_country` VALUES ('BVT', 'Bouvet Island', 'BV');
INSERT INTO `core_country` VALUES ('BWA', 'Botswana', 'BW');
INSERT INTO `core_country` VALUES ('CAF', 'Central African Republic', 'CF');
INSERT INTO `core_country` VALUES ('CAN', 'Canada', 'CA');
INSERT INTO `core_country` VALUES ('CCK', 'Cocos (Keeling) Islands', 'CC');
INSERT INTO `core_country` VALUES ('CHE', 'Switzerland', 'CH');
INSERT INTO `core_country` VALUES ('CHL', 'Chile', 'CL');
INSERT INTO `core_country` VALUES ('CHN', 'China', 'CN');
INSERT INTO `core_country` VALUES ('CIV', 'CÃ´te dâ€™Ivoire', 'CI');
INSERT INTO `core_country` VALUES ('CMR', 'Cameroon', 'CM');
INSERT INTO `core_country` VALUES ('COD', 'Congo, The Democratic Republic of the', 'CD');
INSERT INTO `core_country` VALUES ('COG', 'Congo', 'CG');
INSERT INTO `core_country` VALUES ('COK', 'Cook Islands', 'CK');
INSERT INTO `core_country` VALUES ('COL', 'Colombia', 'CO');
INSERT INTO `core_country` VALUES ('COM', 'Comoros', 'KM');
INSERT INTO `core_country` VALUES ('CPV', 'Cape Verde', 'CV');
INSERT INTO `core_country` VALUES ('CRI', 'Costa Rica', 'CR');
INSERT INTO `core_country` VALUES ('CUB', 'Cuba', 'CU');
INSERT INTO `core_country` VALUES ('CXR', 'Christmas Island', 'CX');
INSERT INTO `core_country` VALUES ('CYM', 'Cayman Islands', 'KY');
INSERT INTO `core_country` VALUES ('CYP', 'Cyprus', 'CY');
INSERT INTO `core_country` VALUES ('CZE', 'Czech Republic', 'CZ');
INSERT INTO `core_country` VALUES ('DEU', 'Germany', 'DE');
INSERT INTO `core_country` VALUES ('DJI', 'Djibouti', 'DJ');
INSERT INTO `core_country` VALUES ('DMA', 'Dominica', 'DM');
INSERT INTO `core_country` VALUES ('DNK', 'Denmark', 'DK');
INSERT INTO `core_country` VALUES ('DOM', 'Dominican Republic', 'DO');
INSERT INTO `core_country` VALUES ('DZA', 'Algeria', 'DZ');
INSERT INTO `core_country` VALUES ('ECU', 'Ecuador', 'EC');
INSERT INTO `core_country` VALUES ('EGY', 'Egypt', 'EG');
INSERT INTO `core_country` VALUES ('ERI', 'Eritrea', 'ER');
INSERT INTO `core_country` VALUES ('ESH', 'Western Sahara', 'EH');
INSERT INTO `core_country` VALUES ('ESP', 'Spain', 'ES');
INSERT INTO `core_country` VALUES ('EST', 'Estonia', 'EE');
INSERT INTO `core_country` VALUES ('ETH', 'Ethiopia', 'ET');
INSERT INTO `core_country` VALUES ('FIN', 'Finland', 'FI');
INSERT INTO `core_country` VALUES ('FJI', 'Fiji Islands', 'FJ');
INSERT INTO `core_country` VALUES ('FLK', 'Falkland Islands', 'FK');
INSERT INTO `core_country` VALUES ('FRA', 'France', 'FR');
INSERT INTO `core_country` VALUES ('FRO', 'Faroe Islands', 'FO');
INSERT INTO `core_country` VALUES ('FSM', 'Micronesia, Federated States of', 'FM');
INSERT INTO `core_country` VALUES ('GAB', 'Gabon', 'GA');
INSERT INTO `core_country` VALUES ('GBR', 'United Kingdom', 'GB');
INSERT INTO `core_country` VALUES ('GEO', 'Georgia', 'GE');
INSERT INTO `core_country` VALUES ('GHA', 'Ghana', 'GH');
INSERT INTO `core_country` VALUES ('GIB', 'Gibraltar', 'GI');
INSERT INTO `core_country` VALUES ('GIN', 'Guinea', 'GN');
INSERT INTO `core_country` VALUES ('GLP', 'Guadeloupe', 'GP');
INSERT INTO `core_country` VALUES ('GMB', 'Gambia', 'GM');
INSERT INTO `core_country` VALUES ('GNB', 'Guinea-Bissau', 'GW');
INSERT INTO `core_country` VALUES ('GNQ', 'Equatorial Guinea', 'GQ');
INSERT INTO `core_country` VALUES ('GRC', 'Greece', 'GR');
INSERT INTO `core_country` VALUES ('GRD', 'Grenada', 'GD');
INSERT INTO `core_country` VALUES ('GRL', 'Greenland', 'GL');
INSERT INTO `core_country` VALUES ('GTM', 'Guatemala', 'GT');
INSERT INTO `core_country` VALUES ('GUF', 'French Guiana', 'GF');
INSERT INTO `core_country` VALUES ('GUM', 'Guam', 'GU');
INSERT INTO `core_country` VALUES ('GUY', 'Guyana', 'GY');
INSERT INTO `core_country` VALUES ('HKG', 'Hong Kong', 'HK');
INSERT INTO `core_country` VALUES ('HMD', 'Heard Island and McDonald Islands', 'HM');
INSERT INTO `core_country` VALUES ('HND', 'Honduras', 'HN');
INSERT INTO `core_country` VALUES ('HRV', 'Croatia', 'HR');
INSERT INTO `core_country` VALUES ('HTI', 'Haiti', 'HT');
INSERT INTO `core_country` VALUES ('HUN', 'Hungary', 'HU');
INSERT INTO `core_country` VALUES ('IDN', 'Indonesia', 'ID');
INSERT INTO `core_country` VALUES ('IND', 'India', 'IN');
INSERT INTO `core_country` VALUES ('IOT', 'British Indian Ocean Territory', 'IO');
INSERT INTO `core_country` VALUES ('IRL', 'Ireland', 'IE');
INSERT INTO `core_country` VALUES ('IRN', 'Iran', 'IR');
INSERT INTO `core_country` VALUES ('IRQ', 'Iraq', 'IQ');
INSERT INTO `core_country` VALUES ('ISL', 'Iceland', 'IS');
INSERT INTO `core_country` VALUES ('ISR', 'Israel', 'IL');
INSERT INTO `core_country` VALUES ('ITA', 'Italy', 'IT');
INSERT INTO `core_country` VALUES ('JAM', 'Jamaica', 'JM');
INSERT INTO `core_country` VALUES ('JOR', 'Jordan', 'JO');
INSERT INTO `core_country` VALUES ('JPN', 'Japan', 'JP');
INSERT INTO `core_country` VALUES ('KAZ', 'Kazakstan', 'KZ');
INSERT INTO `core_country` VALUES ('KEN', 'Kenya', 'KE');
INSERT INTO `core_country` VALUES ('KGZ', 'Kyrgyzstan', 'KG');
INSERT INTO `core_country` VALUES ('KHM', 'Cambodia', 'KH');
INSERT INTO `core_country` VALUES ('KIR', 'Kiribati', 'KI');
INSERT INTO `core_country` VALUES ('KNA', 'Saint Kitts and Nevis', 'KN');
INSERT INTO `core_country` VALUES ('KOR', 'South Korea', 'KR');
INSERT INTO `core_country` VALUES ('KWT', 'Kuwait', 'KW');
INSERT INTO `core_country` VALUES ('LAO', 'Laos', 'LA');
INSERT INTO `core_country` VALUES ('LBN', 'Lebanon', 'LB');
INSERT INTO `core_country` VALUES ('LBR', 'Liberia', 'LR');
INSERT INTO `core_country` VALUES ('LBY', 'Libyan Arab Jamahiriya', 'LY');
INSERT INTO `core_country` VALUES ('LCA', 'Saint Lucia', 'LC');
INSERT INTO `core_country` VALUES ('LIE', 'Liechtenstein', 'LI');
INSERT INTO `core_country` VALUES ('LKA', 'Sri Lanka', 'LK');
INSERT INTO `core_country` VALUES ('LSO', 'Lesotho', 'LS');
INSERT INTO `core_country` VALUES ('LTU', 'Lithuania', 'LT');
INSERT INTO `core_country` VALUES ('LUX', 'Luxembourg', 'LU');
INSERT INTO `core_country` VALUES ('LVA', 'Latvia', 'LV');
INSERT INTO `core_country` VALUES ('MAC', 'Macao', 'MO');
INSERT INTO `core_country` VALUES ('MAR', 'Morocco', 'MA');
INSERT INTO `core_country` VALUES ('MCO', 'Monaco', 'MC');
INSERT INTO `core_country` VALUES ('MDA', 'Moldova', 'MD');
INSERT INTO `core_country` VALUES ('MDG', 'Madagascar', 'MG');
INSERT INTO `core_country` VALUES ('MDV', 'Maldives', 'MV');
INSERT INTO `core_country` VALUES ('MEX', 'Mexico', 'MX');
INSERT INTO `core_country` VALUES ('MHL', 'Marshall Islands', 'MH');
INSERT INTO `core_country` VALUES ('MKD', 'Macedonia', 'MK');
INSERT INTO `core_country` VALUES ('MLI', 'Mali', 'ML');
INSERT INTO `core_country` VALUES ('MLT', 'Malta', 'MT');
INSERT INTO `core_country` VALUES ('MMR', 'Myanmar', 'MM');
INSERT INTO `core_country` VALUES ('MNG', 'Mongolia', 'MN');
INSERT INTO `core_country` VALUES ('MNP', 'Northern Mariana Islands', 'MP');
INSERT INTO `core_country` VALUES ('MOZ', 'Mozambique', 'MZ');
INSERT INTO `core_country` VALUES ('MRT', 'Mauritania', 'MR');
INSERT INTO `core_country` VALUES ('MSR', 'Montserrat', 'MS');
INSERT INTO `core_country` VALUES ('MTQ', 'Martinique', 'MQ');
INSERT INTO `core_country` VALUES ('MUS', 'Mauritius', 'MU');
INSERT INTO `core_country` VALUES ('MWI', 'Malawi', 'MW');
INSERT INTO `core_country` VALUES ('MYS', 'Malaysia', 'MY');
INSERT INTO `core_country` VALUES ('MYT', 'Mayotte', 'YT');
INSERT INTO `core_country` VALUES ('NAM', 'Namibia', 'NA');
INSERT INTO `core_country` VALUES ('NCL', 'New Caledonia', 'NC');
INSERT INTO `core_country` VALUES ('NER', 'Niger', 'NE');
INSERT INTO `core_country` VALUES ('NFK', 'Norfolk Island', 'NF');
INSERT INTO `core_country` VALUES ('NGA', 'Nigeria', 'NG');
INSERT INTO `core_country` VALUES ('NIC', 'Nicaragua', 'NI');
INSERT INTO `core_country` VALUES ('NIU', 'Niue', 'NU');
INSERT INTO `core_country` VALUES ('NLD', 'Netherlands', 'NL');
INSERT INTO `core_country` VALUES ('NOR', 'Norway', 'NO');
INSERT INTO `core_country` VALUES ('NPL', 'Nepal', 'NP');
INSERT INTO `core_country` VALUES ('NRU', 'Nauru', 'NR');
INSERT INTO `core_country` VALUES ('NZL', 'New Zealand', 'NZ');
INSERT INTO `core_country` VALUES ('OMN', 'Oman', 'OM');
INSERT INTO `core_country` VALUES ('PAK', 'Pakistan', 'PK');
INSERT INTO `core_country` VALUES ('PAN', 'Panama', 'PA');
INSERT INTO `core_country` VALUES ('PCN', 'Pitcairn', 'PN');
INSERT INTO `core_country` VALUES ('PER', 'Peru', 'PE');
INSERT INTO `core_country` VALUES ('PHL', 'Philippines', 'PH');
INSERT INTO `core_country` VALUES ('PLW', 'Palau', 'PW');
INSERT INTO `core_country` VALUES ('PNG', 'Papua New Guinea', 'PG');
INSERT INTO `core_country` VALUES ('POL', 'Poland', 'PL');
INSERT INTO `core_country` VALUES ('PRI', 'Puerto Rico', 'PR');
INSERT INTO `core_country` VALUES ('PRK', 'North Korea', 'KP');
INSERT INTO `core_country` VALUES ('PRT', 'Portugal', 'PT');
INSERT INTO `core_country` VALUES ('PRY', 'Paraguay', 'PY');
INSERT INTO `core_country` VALUES ('PSE', 'Palestine', 'PS');
INSERT INTO `core_country` VALUES ('PYF', 'French Polynesia', 'PF');
INSERT INTO `core_country` VALUES ('QAT', 'Qatar', 'QA');
INSERT INTO `core_country` VALUES ('REU', 'RÃ©union', 'RE');
INSERT INTO `core_country` VALUES ('ROM', 'Romania', 'RO');
INSERT INTO `core_country` VALUES ('RUS', 'Russian Federation', 'RU');
INSERT INTO `core_country` VALUES ('RWA', 'Rwanda', 'RW');
INSERT INTO `core_country` VALUES ('SAU', 'Saudi Arabia', 'SA');
INSERT INTO `core_country` VALUES ('SDN', 'Sudan', 'SD');
INSERT INTO `core_country` VALUES ('SEN', 'Senegal', 'SN');
INSERT INTO `core_country` VALUES ('SGP', 'Singapore', 'SG');
INSERT INTO `core_country` VALUES ('SGS', 'South Georgia and the South Sandwich Islands', 'GS');
INSERT INTO `core_country` VALUES ('SHN', 'Saint Helena', 'SH');
INSERT INTO `core_country` VALUES ('SJM', 'Svalbard and Jan Mayen', 'SJ');
INSERT INTO `core_country` VALUES ('SLB', 'Solomon Islands', 'SB');
INSERT INTO `core_country` VALUES ('SLE', 'Sierra Leone', 'SL');
INSERT INTO `core_country` VALUES ('SLV', 'El Salvador', 'SV');
INSERT INTO `core_country` VALUES ('SMR', 'San Marino', 'SM');
INSERT INTO `core_country` VALUES ('SOM', 'Somalia', 'SO');
INSERT INTO `core_country` VALUES ('SPM', 'Saint Pierre and Miquelon', 'PM');
INSERT INTO `core_country` VALUES ('STP', 'Sao Tome and Principe', 'ST');
INSERT INTO `core_country` VALUES ('SUR', 'Suriname', 'SR');
INSERT INTO `core_country` VALUES ('SVK', 'Slovakia', 'SK');
INSERT INTO `core_country` VALUES ('SVN', 'Slovenia', 'SI');
INSERT INTO `core_country` VALUES ('SWE', 'Sweden', 'SE');
INSERT INTO `core_country` VALUES ('SWZ', 'Swaziland', 'SZ');
INSERT INTO `core_country` VALUES ('SYC', 'Seychelles', 'SC');
INSERT INTO `core_country` VALUES ('SYR', 'Syria', 'SY');
INSERT INTO `core_country` VALUES ('TCA', 'Turks and Caicos Islands', 'TC');
INSERT INTO `core_country` VALUES ('TCD', 'Chad', 'TD');
INSERT INTO `core_country` VALUES ('TGO', 'Togo', 'TG');
INSERT INTO `core_country` VALUES ('THA', 'Thailand', 'TH');
INSERT INTO `core_country` VALUES ('TJK', 'Tajikistan', 'TJ');
INSERT INTO `core_country` VALUES ('TKL', 'Tokelau', 'TK');
INSERT INTO `core_country` VALUES ('TKM', 'Turkmenistan', 'TM');
INSERT INTO `core_country` VALUES ('TMP', 'East Timor', 'TP');
INSERT INTO `core_country` VALUES ('TON', 'Tonga', 'TO');
INSERT INTO `core_country` VALUES ('TTO', 'Trinidad and Tobago', 'TT');
INSERT INTO `core_country` VALUES ('TUN', 'Tunisia', 'TN');
INSERT INTO `core_country` VALUES ('TUR', 'Turkey', 'TR');
INSERT INTO `core_country` VALUES ('TUV', 'Tuvalu', 'TV');
INSERT INTO `core_country` VALUES ('TWN', 'Taiwan', 'TW');
INSERT INTO `core_country` VALUES ('TZA', 'Tanzania', 'TZ');
INSERT INTO `core_country` VALUES ('UGA', 'Uganda', 'UG');
INSERT INTO `core_country` VALUES ('UKR', 'Ukraine', 'UA');
INSERT INTO `core_country` VALUES ('UMI', 'United States Minor Outlying Islands', 'UM');
INSERT INTO `core_country` VALUES ('URY', 'Uruguay', 'UY');
INSERT INTO `core_country` VALUES ('USA', 'United States', 'US');
INSERT INTO `core_country` VALUES ('UZB', 'Uzbekistan', 'UZ');
INSERT INTO `core_country` VALUES ('VAT', 'Holy See (Vatican City State)', 'VA');
INSERT INTO `core_country` VALUES ('VCT', 'Saint Vincent and the Grenadines', 'VC');
INSERT INTO `core_country` VALUES ('VEN', 'Venezuela', 'VE');
INSERT INTO `core_country` VALUES ('VGB', 'Virgin Islands, British', 'VG');
INSERT INTO `core_country` VALUES ('VIR', 'Virgin Islands, U.S.', 'VI');
INSERT INTO `core_country` VALUES ('VNM', 'Vietnam', 'VN');
INSERT INTO `core_country` VALUES ('VUT', 'Vanuatu', 'VU');
INSERT INTO `core_country` VALUES ('WLF', 'Wallis and Futuna', 'WF');
INSERT INTO `core_country` VALUES ('WSM', 'Samoa', 'WS');
INSERT INTO `core_country` VALUES ('YEM', 'Yemen', 'YE');
INSERT INTO `core_country` VALUES ('YUG', 'Yugoslavia', 'YU');
INSERT INTO `core_country` VALUES ('ZAF', 'South Africa', 'ZA');
INSERT INTO `core_country` VALUES ('ZMB', 'Zambia', 'ZM');
INSERT INTO `core_country` VALUES ('ZWE', 'Zimbabwe', 'ZW');

-- ----------------------------
-- Table structure for core_department
-- ----------------------------
DROP TABLE IF EXISTS `core_department`;
CREATE TABLE `core_department` (
  `department_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_status` tinyint(1) NOT NULL DEFAULT '0',
  `department_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `department_code_index` (`department_code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_department
-- ----------------------------
INSERT INTO `core_department` VALUES ('5', 'Khoa học giáo dục', null, '1', null);
INSERT INTO `core_department` VALUES ('7', 'Sư phạm', '1', '1', '2015-03-25 14:38:10');

-- ----------------------------
-- Table structure for core_department_subject
-- ----------------------------
DROP TABLE IF EXISTS `core_department_subject`;
CREATE TABLE `core_department_subject` (
  `department_subject_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_subject_department` int(11) unsigned DEFAULT '0',
  `department_subject_subject` int(11) DEFAULT '0',
  `department_subject_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`department_subject_id`),
  UNIQUE KEY `department_subject_index` (`department_subject_department`,`department_subject_subject`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_department_subject
-- ----------------------------
INSERT INTO `core_department_subject` VALUES ('7', '5', '8', '0');
INSERT INTO `core_department_subject` VALUES ('9', '7', '9', '0');
INSERT INTO `core_department_subject` VALUES ('10', '7', '10', '0');
INSERT INTO `core_department_subject` VALUES ('11', '7', '11', '0');
INSERT INTO `core_department_subject` VALUES ('12', '7', '12', '0');
INSERT INTO `core_department_subject` VALUES ('13', '7', '13', '0');
INSERT INTO `core_department_subject` VALUES ('14', '7', '14', '0');
INSERT INTO `core_department_subject` VALUES ('15', '7', '15', '0');
INSERT INTO `core_department_subject` VALUES ('16', '7', '16', '0');
INSERT INTO `core_department_subject` VALUES ('17', '7', '17', '0');
INSERT INTO `core_department_subject` VALUES ('18', '7', '18', '0');
INSERT INTO `core_department_subject` VALUES ('19', '7', '19', '0');
INSERT INTO `core_department_subject` VALUES ('20', '7', '20', '0');
INSERT INTO `core_department_subject` VALUES ('21', '7', '21', '0');
INSERT INTO `core_department_subject` VALUES ('22', '5', '7', '0');
INSERT INTO `core_department_subject` VALUES ('23', '7', '7', '0');
INSERT INTO `core_department_subject` VALUES ('24', '7', '22', '0');

-- ----------------------------
-- Table structure for core_exam
-- ----------------------------
DROP TABLE IF EXISTS `core_exam`;
CREATE TABLE `core_exam` (
  `exam_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exam_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exam_subject` int(11) NOT NULL DEFAULT '0',
  `exam_creator` int(11) unsigned NOT NULL DEFAULT '0',
  `exam_editor` int(1) NOT NULL DEFAULT '0',
  `exam_status` tinyint(1) NOT NULL DEFAULT '0',
  `exam_mark` int(10) DEFAULT '0',
  `exam_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_exam
-- ----------------------------
INSERT INTO `core_exam` VALUES ('1', null, 'A34', '2', '3', '0', '1', '100', '2015-03-05 01:45:25');
INSERT INTO `core_exam` VALUES ('2', null, '3464545645rtg', '2', '3', '0', '1', '100', '2015-03-05 01:48:30');
INSERT INTO `core_exam` VALUES ('3', null, '5654645', '2', '3', '0', '1', '100', '2015-03-05 01:48:50');
INSERT INTO `core_exam` VALUES ('4', null, '36gffdg', '2', '3', '0', '1', '124', '2015-03-05 01:49:16');
INSERT INTO `core_exam` VALUES ('5', null, 'TD1', '11', '14', '0', '1', '10', '2015-03-27 09:37:43');
INSERT INTO `core_exam` VALUES ('6', null, 'Đề thi - Demo', '24', '32', '0', '1', '10', '2015-03-30 17:53:53');
INSERT INTO `core_exam` VALUES ('7', null, 'H1', '25', '34', '0', '1', '10', '2015-03-30 18:25:09');
INSERT INTO `core_exam` VALUES ('8', null, '1', '11', '14', '0', '1', '10', '2015-05-06 09:53:00');
INSERT INTO `core_exam` VALUES ('9', null, 'kl', '23', '38', '0', '1', '10', '2015-05-06 10:49:17');
INSERT INTO `core_exam` VALUES ('10', null, 'HH', '24', '40', '0', '1', '10', '2015-05-06 10:58:48');
INSERT INTO `core_exam` VALUES ('11', null, 'VN', '22', '36', '0', '1', '10', '2015-05-06 14:26:48');
INSERT INTO `core_exam` VALUES ('12', null, 'TD 3', '11', '14', '0', '1', '10', '2015-05-14 18:38:11');
INSERT INTO `core_exam` VALUES ('13', null, '123456', '7', '2', '0', '1', '100', '2015-09-14 07:36:04');

-- ----------------------------
-- Table structure for core_exam_answer
-- ----------------------------
DROP TABLE IF EXISTS `core_exam_answer`;
CREATE TABLE `core_exam_answer` (
  `exam_answer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exam_answer_student` int(11) NOT NULL DEFAULT '0',
  `exam_answer_exam` int(11) NOT NULL DEFAULT '0',
  `exam_answer_question` int(11) NOT NULL DEFAULT '0',
  `exam_answer_answer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exam_answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_exam_answer
-- ----------------------------
INSERT INTO `core_exam_answer` VALUES ('1', '4', '5', '7', '18');
INSERT INTO `core_exam_answer` VALUES ('2', '4', '5', '6', '13');
INSERT INTO `core_exam_answer` VALUES ('3', '4', '5', '6', '12');
INSERT INTO `core_exam_answer` VALUES ('5', '4', '6', '6', '12');
INSERT INTO `core_exam_answer` VALUES ('6', '5', '8', '9', '25');
INSERT INTO `core_exam_answer` VALUES ('7', '5', '8', '6', '13');
INSERT INTO `core_exam_answer` VALUES ('8', '5', '8', '6', '12');
INSERT INTO `core_exam_answer` VALUES ('9', '11', '7', '132', '517');
INSERT INTO `core_exam_answer` VALUES ('16', '6', '5', '96', '377');
INSERT INTO `core_exam_answer` VALUES ('25', '6', '5', '95', '375');
INSERT INTO `core_exam_answer` VALUES ('26', '6', '5', '92', '364');
INSERT INTO `core_exam_answer` VALUES ('27', '6', '5', '91', '357');
INSERT INTO `core_exam_answer` VALUES ('28', '6', '5', '91', '360');
INSERT INTO `core_exam_answer` VALUES ('29', '6', '5', '99', '392');
INSERT INTO `core_exam_answer` VALUES ('30', '6', '5', '97', '383');
INSERT INTO `core_exam_answer` VALUES ('31', '6', '5', '98', '386');
INSERT INTO `core_exam_answer` VALUES ('32', '6', '5', '100', '396');
INSERT INTO `core_exam_answer` VALUES ('33', '6', '5', '100', '395');
INSERT INTO `core_exam_answer` VALUES ('34', '6', '5', '100', '393');
INSERT INTO `core_exam_answer` VALUES ('35', '6', '5', '93', '365');
INSERT INTO `core_exam_answer` VALUES ('36', '6', '5', '94', '370');
INSERT INTO `core_exam_answer` VALUES ('37', '6', '8', '95', '375');
INSERT INTO `core_exam_answer` VALUES ('38', '6', '8', '100', '396');
INSERT INTO `core_exam_answer` VALUES ('39', '6', '8', '94', '370');
INSERT INTO `core_exam_answer` VALUES ('40', '6', '8', '102', '401');
INSERT INTO `core_exam_answer` VALUES ('42', '12', '9', '134', '528');
INSERT INTO `core_exam_answer` VALUES ('43', '13', '10', '135', '536');
INSERT INTO `core_exam_answer` VALUES ('44', '13', '10', '131', '513');
INSERT INTO `core_exam_answer` VALUES ('53', '6', '11', '107', '420');
INSERT INTO `core_exam_answer` VALUES ('54', '6', '11', '105', '409');
INSERT INTO `core_exam_answer` VALUES ('55', '6', '11', '108', '424');
INSERT INTO `core_exam_answer` VALUES ('56', '6', '11', '106', '413');
INSERT INTO `core_exam_answer` VALUES ('57', '6', '11', '111', '435');
INSERT INTO `core_exam_answer` VALUES ('58', '7', '11', '106', '413');
INSERT INTO `core_exam_answer` VALUES ('59', '6', '12', '95', '375');
INSERT INTO `core_exam_answer` VALUES ('60', '6', '12', '99', '391');
INSERT INTO `core_exam_answer` VALUES ('61', '6', '12', '96', '379');
INSERT INTO `core_exam_answer` VALUES ('62', '6', '12', '94', '370');
INSERT INTO `core_exam_answer` VALUES ('63', '6', '12', '91', '359');
INSERT INTO `core_exam_answer` VALUES ('64', '6', '12', '98', '386');
INSERT INTO `core_exam_answer` VALUES ('65', '6', '12', '133', '525');
INSERT INTO `core_exam_answer` VALUES ('66', '6', '12', '102', '402');
INSERT INTO `core_exam_answer` VALUES ('67', '6', '12', '97', '381');
INSERT INTO `core_exam_answer` VALUES ('68', '6', '12', '100', '394');
INSERT INTO `core_exam_answer` VALUES ('69', '6', '12', '101', '400');
INSERT INTO `core_exam_answer` VALUES ('70', '6', '12', '92', '362');
INSERT INTO `core_exam_answer` VALUES ('72', '6', '12', '93', '365');

-- ----------------------------
-- Table structure for core_exam_management
-- ----------------------------
DROP TABLE IF EXISTS `core_exam_management`;
CREATE TABLE `core_exam_management` (
  `exam_management_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exam_management_exam` int(11) DEFAULT '0',
  `exam_management_execution_duration` int(11) NOT NULL DEFAULT '0',
  `exam_management_start_time` datetime DEFAULT NULL,
  `exam_management_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`exam_management_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_exam_management
-- ----------------------------
INSERT INTO `core_exam_management` VALUES ('1', '1', '100', '2015-03-11 08:03:00', '1');
INSERT INTO `core_exam_management` VALUES ('2', '2', '900', '2015-03-11 11:27:00', '1');
INSERT INTO `core_exam_management` VALUES ('3', '3', '91', '2015-03-11 03:05:00', '1');
INSERT INTO `core_exam_management` VALUES ('4', '4', '100', '2015-03-11 05:57:00', '1');
INSERT INTO `core_exam_management` VALUES ('5', '5', '10', '2015-06-25 17:45:00', '1');
INSERT INTO `core_exam_management` VALUES ('6', '6', '1', '2015-03-30 17:55:00', '1');
INSERT INTO `core_exam_management` VALUES ('7', '7', '5', '2015-03-30 18:25:00', '1');
INSERT INTO `core_exam_management` VALUES ('8', '8', '5', '2015-05-06 09:55:00', '1');
INSERT INTO `core_exam_management` VALUES ('9', '9', '5', '2015-05-06 11:00:00', '1');
INSERT INTO `core_exam_management` VALUES ('10', '10', '5', '2015-05-06 11:00:00', '1');
INSERT INTO `core_exam_management` VALUES ('11', '11', '10', '2015-05-06 14:25:00', '1');
INSERT INTO `core_exam_management` VALUES ('12', '12', '10', '2015-05-14 18:35:00', '1');
INSERT INTO `core_exam_management` VALUES ('13', '13', '1000', '2016-01-19 08:00:00', '1');

-- ----------------------------
-- Table structure for core_exam_question
-- ----------------------------
DROP TABLE IF EXISTS `core_exam_question`;
CREATE TABLE `core_exam_question` (
  `exam_question_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exam_question_exam` int(11) NOT NULL DEFAULT '0',
  `exam_question_question` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exam_question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_exam_question
-- ----------------------------
INSERT INTO `core_exam_question` VALUES ('17', '2', '5');
INSERT INTO `core_exam_question` VALUES ('18', '3', '1');
INSERT INTO `core_exam_question` VALUES ('21', '4', '1');
INSERT INTO `core_exam_question` VALUES ('26', '1', '1');
INSERT INTO `core_exam_question` VALUES ('27', '1', '4');
INSERT INTO `core_exam_question` VALUES ('28', '1', '5');
INSERT INTO `core_exam_question` VALUES ('39', '6', '131');
INSERT INTO `core_exam_question` VALUES ('40', '7', '132');
INSERT INTO `core_exam_question` VALUES ('41', '5', '93');
INSERT INTO `core_exam_question` VALUES ('42', '5', '95');
INSERT INTO `core_exam_question` VALUES ('43', '5', '98');
INSERT INTO `core_exam_question` VALUES ('44', '5', '100');
INSERT INTO `core_exam_question` VALUES ('45', '5', '91');
INSERT INTO `core_exam_question` VALUES ('46', '5', '92');
INSERT INTO `core_exam_question` VALUES ('47', '5', '94');
INSERT INTO `core_exam_question` VALUES ('48', '5', '97');
INSERT INTO `core_exam_question` VALUES ('49', '5', '96');
INSERT INTO `core_exam_question` VALUES ('50', '5', '99');
INSERT INTO `core_exam_question` VALUES ('51', '8', '93');
INSERT INTO `core_exam_question` VALUES ('52', '8', '95');
INSERT INTO `core_exam_question` VALUES ('53', '8', '98');
INSERT INTO `core_exam_question` VALUES ('54', '8', '100');
INSERT INTO `core_exam_question` VALUES ('55', '8', '102');
INSERT INTO `core_exam_question` VALUES ('56', '8', '133');
INSERT INTO `core_exam_question` VALUES ('57', '8', '91');
INSERT INTO `core_exam_question` VALUES ('58', '8', '92');
INSERT INTO `core_exam_question` VALUES ('59', '8', '94');
INSERT INTO `core_exam_question` VALUES ('60', '8', '96');
INSERT INTO `core_exam_question` VALUES ('62', '10', '131');
INSERT INTO `core_exam_question` VALUES ('63', '10', '135');
INSERT INTO `core_exam_question` VALUES ('64', '9', '134');
INSERT INTO `core_exam_question` VALUES ('65', '11', '105');
INSERT INTO `core_exam_question` VALUES ('66', '11', '111');
INSERT INTO `core_exam_question` VALUES ('67', '11', '106');
INSERT INTO `core_exam_question` VALUES ('68', '11', '107');
INSERT INTO `core_exam_question` VALUES ('69', '11', '108');
INSERT INTO `core_exam_question` VALUES ('70', '12', '93');
INSERT INTO `core_exam_question` VALUES ('71', '12', '95');
INSERT INTO `core_exam_question` VALUES ('72', '12', '98');
INSERT INTO `core_exam_question` VALUES ('73', '12', '100');
INSERT INTO `core_exam_question` VALUES ('74', '12', '102');
INSERT INTO `core_exam_question` VALUES ('75', '12', '133');
INSERT INTO `core_exam_question` VALUES ('76', '12', '136');
INSERT INTO `core_exam_question` VALUES ('77', '12', '91');
INSERT INTO `core_exam_question` VALUES ('78', '12', '92');
INSERT INTO `core_exam_question` VALUES ('79', '12', '94');
INSERT INTO `core_exam_question` VALUES ('80', '12', '97');
INSERT INTO `core_exam_question` VALUES ('81', '12', '101');
INSERT INTO `core_exam_question` VALUES ('82', '12', '96');
INSERT INTO `core_exam_question` VALUES ('83', '12', '99');
INSERT INTO `core_exam_question` VALUES ('84', '13', '85');

-- ----------------------------
-- Table structure for core_exam_student
-- ----------------------------
DROP TABLE IF EXISTS `core_exam_student`;
CREATE TABLE `core_exam_student` (
  `exam_student_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exam_student_exam_management` int(11) NOT NULL DEFAULT '0',
  `exam_student_student` int(11) NOT NULL DEFAULT '0',
  `exam_student_executed` tinyint(1) NOT NULL DEFAULT '1',
  `exam_student_end_time` datetime DEFAULT NULL,
  `exam_student_involved_time` datetime DEFAULT NULL,
  PRIMARY KEY (`exam_student_id`),
  UNIQUE KEY `exam_management_student` (`exam_student_exam_management`,`exam_student_student`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_exam_student
-- ----------------------------
INSERT INTO `core_exam_student` VALUES ('19', '2', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `core_exam_student` VALUES ('20', '3', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `core_exam_student` VALUES ('24', '4', '1', '1', '2015-03-11 07:37:39', '2015-03-11 05:59:47');
INSERT INTO `core_exam_student` VALUES ('25', '4', '2', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('29', '1', '2', '0', null, '2015-03-11 08:03:25');
INSERT INTO `core_exam_student` VALUES ('34', '6', '10', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('35', '7', '11', '1', '2015-03-30 18:26:24', '2015-03-30 18:25:42');
INSERT INTO `core_exam_student` VALUES ('36', '5', '6', '0', null, '2015-05-05 17:45:24');
INSERT INTO `core_exam_student` VALUES ('37', '5', '7', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('38', '5', '8', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('39', '5', '9', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('40', '8', '6', '1', '2015-05-06 10:00:04', '2015-05-06 09:55:04');
INSERT INTO `core_exam_student` VALUES ('41', '8', '7', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('42', '8', '8', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('43', '8', '9', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('45', '10', '13', '1', '2015-05-06 11:01:11', '2015-05-06 11:00:02');
INSERT INTO `core_exam_student` VALUES ('46', '9', '12', '1', '2015-05-06 11:05:00', '2015-05-06 11:00:24');
INSERT INTO `core_exam_student` VALUES ('47', '11', '6', '1', '2015-05-06 14:30:05', '2015-05-06 14:27:24');
INSERT INTO `core_exam_student` VALUES ('48', '11', '7', '1', '2015-05-06 14:34:59', '2015-05-06 14:30:59');
INSERT INTO `core_exam_student` VALUES ('49', '11', '8', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('50', '11', '9', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('51', '12', '6', '1', '2015-05-14 18:39:43', '2015-05-14 18:38:39');
INSERT INTO `core_exam_student` VALUES ('52', '12', '7', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('53', '12', '8', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('54', '12', '9', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('55', '13', '4', '0', null, null);
INSERT INTO `core_exam_student` VALUES ('56', '13', '5', '0', null, null);

-- ----------------------------
-- Table structure for core_imex
-- ----------------------------
DROP TABLE IF EXISTS `core_imex`;
CREATE TABLE `core_imex` (
  `imex_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `imex_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imex_name` text COLLATE utf8_unicode_ci,
  `imex_template` text COLLATE utf8_unicode_ci,
  `imex_type` enum('TEACHER','STUDENT') COLLATE utf8_unicode_ci DEFAULT NULL,
  `imex_status` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`imex_id`),
  UNIQUE KEY `imex_code_index` (`imex_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_imex
-- ----------------------------
INSERT INTO `core_imex` VALUES ('1', null, 'Format #01', '{\r\n    \"fields\": {\r\n        \"STUDENT_NAME\": {\r\n            \"label\": \"StudentForm:@Full name\",\r\n            \"required\": true,\r\n            \"filters\": [\"StringTrim\", \"StripTags\"],\r\n            \"validators\": [\"NotEmpty\"]\r\n        },\r\n				\"STUDENT_CODE\": {\r\n            \"label\": \"StudentForm:@Code\",\r\n            \"required\": true,\r\n            \"filters\": [\"StringTrim\", \"StripTags\"],\r\n            \"validators\": [\"NotEmpty\", [\"Db_NoRecordExists\", true, [\"core_student\", \"student_code\"]]]\r\n        },\r\n				\"STUDENT_CLASSES\": {\r\n            \"label\": \"ClassForm:@Code\",\r\n            \"required\": true,\r\n            \"filters\": [\"StringTrim\", \"StripTags\"],\r\n            \"validators\": [\"NotEmpty\", \"InArray\"]\r\n        },\r\n				\"STUDENT_DEPARTMENT\": {\r\n            \"label\": \"DepartmentForm:@Code\",\r\n            \"required\": true,\r\n            \"filters\": [\"StringTrim\", \"StripTags\"],\r\n            \"validators\": [\"NotEmpty\", \"InArray\"]\r\n        }\r\n    },\r\n		\"validators\": {\r\n				\"STUDENT_CLASSES\": {\r\n						\"InArray\": \"Admin_Imex_Validator::getClasses\"\r\n				},\r\n				\"STUDENT_DEPARTMENT\": {\r\n						\"InArray\": \"Admin_Imex_Validator::getDepartments\"\r\n				}\r\n		}\r\n}', 'STUDENT', '1');

-- ----------------------------
-- Table structure for core_imex_field
-- ----------------------------
DROP TABLE IF EXISTS `core_imex_field`;
CREATE TABLE `core_imex_field` (
  `imex_field_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `imex_field_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imex_field_options` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`imex_field_id`),
  UNIQUE KEY `imex_field_name_index` (`imex_field_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_imex_field
-- ----------------------------

-- ----------------------------
-- Table structure for core_media
-- ----------------------------
DROP TABLE IF EXISTS `core_media`;
CREATE TABLE `core_media` (
  `media_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `media_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `media_url` tinytext COLLATE utf8_unicode_ci,
  `media_is_local` tinyint(1) DEFAULT '1',
  `media_creator` int(10) DEFAULT NULL,
  `media_date_created` datetime NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_media
-- ----------------------------

-- ----------------------------
-- Table structure for core_module
-- ----------------------------
DROP TABLE IF EXISTS `core_module`;
CREATE TABLE `core_module` (
  `module_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `module_code` varchar(50) NOT NULL,
  `module_description` text,
  PRIMARY KEY (`module_id`,`module_code`),
  KEY `module_code_index` (`module_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_module
-- ----------------------------
INSERT INTO `core_module` VALUES ('1', 'Backend', 'admin', null);
INSERT INTO `core_module` VALUES ('2', 'Frontend', 'default', null);

-- ----------------------------
-- Table structure for core_navigation
-- ----------------------------
DROP TABLE IF EXISTS `core_navigation`;
CREATE TABLE `core_navigation` (
  `navigation_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `navigation_level` tinyint(5) NOT NULL DEFAULT '0',
  `navigation_left` int(11) NOT NULL,
  `navigation_right` int(11) NOT NULL,
  `navigation_module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigation_url` tinytext COLLATE utf8_unicode_ci,
  `navigation_privilege` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigation_date_created` datetime NOT NULL,
  PRIMARY KEY (`navigation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_navigation
-- ----------------------------
INSERT INTO `core_navigation` VALUES ('1', 'NavbarLeft:@Manage exams', '0', '1', '8', 'admin', '#', '', '2014-10-15 14:02:15');
INSERT INTO `core_navigation` VALUES ('2', 'NavbarLeft:@All exams', '1', '2', '3', 'admin', 'admin/exam', 'admin@exam@manage', '2014-10-15 14:04:45');
INSERT INTO `core_navigation` VALUES ('3', 'NavbarLeft:@Add new', '1', '4', '5', 'admin', 'admin/exam/add', 'admin@exam@add', '2014-10-15 14:05:25');
INSERT INTO `core_navigation` VALUES ('4', 'NavbarLeft:@Manage questions', '0', '9', '14', 'admin', '#', '', '2014-10-15 14:06:00');
INSERT INTO `core_navigation` VALUES ('5', 'NavbarLeft:@All questions', '1', '10', '11', 'admin', 'admin/question', 'admin@question@manage', '2014-10-15 14:06:18');
INSERT INTO `core_navigation` VALUES ('6', 'NavbarLeft:@Add new', '1', '12', '13', 'admin', 'admin/question/add', 'admin@question@add', '2014-10-15 14:06:42');
INSERT INTO `core_navigation` VALUES ('8', 'NavbarLeft:@Exam grades', '1', '6', '7', 'admin', 'admin/score', '', '2014-10-15 14:07:43');
INSERT INTO `core_navigation` VALUES ('9', 'NavbarLeft:@Exam reports', '0', '15', '18', 'admin', '#', '', '2014-10-15 14:08:10');
INSERT INTO `core_navigation` VALUES ('10', 'NavbarLeft:@All reports', '1', '16', '17', 'admin', 'admin/exam/report', 'admin@exam@report', '2014-10-15 14:10:01');
INSERT INTO `core_navigation` VALUES ('11', 'NavbarLeft:@Manage classes', '0', '19', '24', 'admin', '#', '', '2014-10-15 14:11:38');
INSERT INTO `core_navigation` VALUES ('12', 'NavbarLeft:@All classes', '1', '20', '21', 'admin', 'admin/classes', 'admin@classes@manage', '2014-10-15 14:12:21');
INSERT INTO `core_navigation` VALUES ('13', 'NavbarLeft:@Add new', '1', '22', '23', 'admin', 'admin/classes/add', 'admin@classes@add', '2014-10-15 14:12:42');
INSERT INTO `core_navigation` VALUES ('14', 'NavbarLeft:@Manage departments', '0', '25', '30', 'admin', '#', '', '2014-10-15 14:13:07');
INSERT INTO `core_navigation` VALUES ('15', 'NavbarLeft:@All departments', '1', '26', '27', 'admin', 'admin/department', 'admin@department@manage', '2014-10-15 14:13:24');
INSERT INTO `core_navigation` VALUES ('16', 'NavbarLeft:@Add new', '1', '28', '29', 'admin', 'admin/department/add', 'admin@department@add', '2014-10-15 14:13:35');
INSERT INTO `core_navigation` VALUES ('17', 'NavbarLeft:@Manage subjects', '0', '31', '36', 'admin', '#', '', '2014-10-15 14:14:03');
INSERT INTO `core_navigation` VALUES ('18', 'NavbarLeft:@All subjects', '1', '32', '33', 'admin', 'admin/subject', 'admin@subject@manage', '2014-10-15 14:14:21');
INSERT INTO `core_navigation` VALUES ('19', 'NavbarLeft:@Add new', '1', '34', '35', 'admin', 'admin/subject/add', 'admin@subject@add', '2014-10-15 14:14:31');
INSERT INTO `core_navigation` VALUES ('20', 'NavbarLeft:@Manage students', '0', '37', '42', 'admin', '#', '', '2014-10-15 14:14:52');
INSERT INTO `core_navigation` VALUES ('21', 'NavbarLeft:@All students', '1', '38', '39', 'admin', 'admin/student', 'admin@student@manage', '2014-10-15 14:15:21');
INSERT INTO `core_navigation` VALUES ('22', 'NavbarLeft:@Add new', '1', '40', '41', 'admin', 'admin/student/add', 'admin@student@add', '2014-10-15 14:15:33');
INSERT INTO `core_navigation` VALUES ('23', 'NavbarLeft:@Manage teachers', '0', '43', '48', 'admin', '#', '', '2014-10-15 14:16:30');
INSERT INTO `core_navigation` VALUES ('24', 'NavbarLeft:@All teachers', '1', '44', '45', 'admin', 'admin/teacher', 'admin@teacher@manage', '2014-10-15 14:17:46');
INSERT INTO `core_navigation` VALUES ('25', 'NavbarLeft:@Add new', '1', '46', '47', 'admin', 'admin/teacher/add', 'admin@teacher@add', '2014-10-15 14:17:47');
INSERT INTO `core_navigation` VALUES ('26', 'NavbarLeft:@Manage users', '0', '49', '54', 'admin', '#', '', '2014-10-15 14:30:31');
INSERT INTO `core_navigation` VALUES ('27', 'NavbarLeft:@All users', '1', '50', '51', 'admin', 'admin/user', 'admin@user@manage', '2014-10-15 14:29:08');
INSERT INTO `core_navigation` VALUES ('28', 'NavbarLeft:@Add new', '1', '52', '53', 'admin', 'admin/user/add', 'admin@user@add', '2014-10-15 14:29:09');
INSERT INTO `core_navigation` VALUES ('31', 'NavbarLeft:@Manage roles', '0', '55', '60', 'admin', '#', '', '2014-10-15 14:32:19');
INSERT INTO `core_navigation` VALUES ('32', 'NavbarLeft:@All roles', '1', '56', '57', 'admin', 'admin/role', 'admin@role@manage', '2014-10-15 14:32:19');
INSERT INTO `core_navigation` VALUES ('33', 'NavbarLeft:@Add new', '1', '58', '59', 'admin', 'admin/role/add', 'admin@role@add', '2014-10-15 14:32:19');
INSERT INTO `core_navigation` VALUES ('34', 'NavbarLeft:@Tools', '0', '61', '66', 'admin', '#', '', '2014-10-15 14:33:50');
INSERT INTO `core_navigation` VALUES ('35', 'NavbarLeft:@Import teachers', '1', '62', '63', 'admin', 'admin/import/teacher', 'admin@tool@import_teacher', '2014-10-15 14:33:50');
INSERT INTO `core_navigation` VALUES ('36', 'NavbarLeft:@Import students', '1', '64', '65', 'admin', 'admin/import/student', 'admin@tool@import_student', '2014-10-15 14:33:51');
INSERT INTO `core_navigation` VALUES ('37', 'NavbarLeft:@Settings', '0', '67', '72', 'admin', '#', 'admin@setting@manage', '2014-10-15 14:34:11');
INSERT INTO `core_navigation` VALUES ('38', 'NavbarLeft:@Manage media files', '0', '73', '74', 'admin', 'admin/media', 'admin@media@manage', '2014-10-15 14:34:11');
INSERT INTO `core_navigation` VALUES ('39', 'NavbarLeft:@General settings', '1', '68', '69', 'admin', 'admin/setting/general', 'admin@setting@general', '0000-00-00 00:00:00');
INSERT INTO `core_navigation` VALUES ('41', 'NavbarLeft:@Media settings', '1', '70', '71', 'admin', 'admin/setting/media', 'admin@setting@media', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for core_page
-- ----------------------------
DROP TABLE IF EXISTS `core_page`;
CREATE TABLE `core_page` (
  `page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `page_parent` int(11) DEFAULT '0',
  `page_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `sysname` (`page_slug`),
  KEY `parent` (`page_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_page
-- ----------------------------

-- ----------------------------
-- Table structure for core_permission
-- ----------------------------
DROP TABLE IF EXISTS `core_permission`;
CREATE TABLE `core_permission` (
  `permission_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `permission_role` varchar(255) NOT NULL DEFAULT '0',
  `permission_resource` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `role_resource_index` (`permission_role`,`permission_resource`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_permission
-- ----------------------------

-- ----------------------------
-- Table structure for core_permission_inheritance
-- ----------------------------
DROP TABLE IF EXISTS `core_permission_inheritance`;
CREATE TABLE `core_permission_inheritance` (
  `permission_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `permission_user` int(11) NOT NULL DEFAULT '0',
  `permission_resource` text,
  `permission_left_navigation` text,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `permission_user_index` (`permission_user`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_permission_inheritance
-- ----------------------------

-- ----------------------------
-- Table structure for core_privilege
-- ----------------------------
DROP TABLE IF EXISTS `core_privilege`;
CREATE TABLE `core_privilege` (
  `privilege_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `privilege_code` varchar(255) NOT NULL,
  `privilege_module` varchar(50) NOT NULL,
  `privilege_controller` varchar(255) NOT NULL,
  `privilege_description` varchar(255) DEFAULT NULL,
  `privilege_order` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`privilege_id`),
  UNIQUE KEY `module_controller_code_index` (`privilege_module`,`privilege_controller`,`privilege_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_privilege
-- ----------------------------
INSERT INTO `core_privilege` VALUES ('1', 'manage', 'admin', 'teacher', 'PrivilegeLabel:@Manage teachers', '1');
INSERT INTO `core_privilege` VALUES ('2', 'add', 'admin', 'teacher', 'PrivilegeLabel:@Add new teacher', '2');
INSERT INTO `core_privilege` VALUES ('3', 'edit', 'admin', 'teacher', 'PrivilegeLabel:@Edit teacher', '3');
INSERT INTO `core_privilege` VALUES ('4', 'delete', 'admin', 'teacher', 'PrivilegeLabel:@Delete teacher', '4');
INSERT INTO `core_privilege` VALUES ('5', 'manage', 'admin', 'student', 'PrivilegeLabel:@Manage students', '1');
INSERT INTO `core_privilege` VALUES ('6', 'add', 'admin', 'student', 'PrivilegeLabel:@Add new student', '2');
INSERT INTO `core_privilege` VALUES ('7', 'edit', 'admin', 'student', 'PrivilegeLabel:@Edit student', '3');
INSERT INTO `core_privilege` VALUES ('8', 'delete', 'admin', 'student', 'PrivilegeLabel:@Delete student', '4');
INSERT INTO `core_privilege` VALUES ('9', 'manage', 'admin', 'user', 'PrivilegeLabel:@Manage users', '1');
INSERT INTO `core_privilege` VALUES ('10', 'add', 'admin', 'user', 'PrivilegeLabel:@Add new user', '2');
INSERT INTO `core_privilege` VALUES ('11', 'edit', 'admin', 'user', 'PrivilegeLabel:@Edit user', '3');
INSERT INTO `core_privilege` VALUES ('12', 'delete', 'admin', 'user', 'PrivilegeLabel:@Delete user', '4');
INSERT INTO `core_privilege` VALUES ('13', 'manage', 'admin', 'role', 'PrivilegeLabel:@Manage roles', '1');
INSERT INTO `core_privilege` VALUES ('14', 'add', 'admin', 'role', 'PrivilegeLabel:@Add new role', '2');
INSERT INTO `core_privilege` VALUES ('15', 'edit', 'admin', 'role', 'PrivilegeLabel:@Edit role', '3');
INSERT INTO `core_privilege` VALUES ('16', 'delete', 'admin', 'role', 'PrivilegeLabel:@Delete role', '4');
INSERT INTO `core_privilege` VALUES ('17', 'manage', 'admin', 'subject', 'PrivilegeLabel:@Manage subjects', '1');
INSERT INTO `core_privilege` VALUES ('18', 'add', 'admin', 'subject', 'PrivilegeLabel:@Add new subject', '2');
INSERT INTO `core_privilege` VALUES ('19', 'edit', 'admin', 'subject', 'PrivilegeLabel:@Edit subject', '3');
INSERT INTO `core_privilege` VALUES ('20', 'delete', 'admin', 'subject', 'PrivilegeLabel:@Delete subject', '4');
INSERT INTO `core_privilege` VALUES ('21', 'manage', 'admin', 'department', 'PrivilegeLabel:@Manage departments', '1');
INSERT INTO `core_privilege` VALUES ('22', 'add', 'admin', 'department', 'PrivilegeLabel:@Add new department', '2');
INSERT INTO `core_privilege` VALUES ('23', 'edit', 'admin', 'department', 'PrivilegeLabel:@Edit department', '3');
INSERT INTO `core_privilege` VALUES ('24', 'delete', 'admin', 'department', 'PrivilegeLabel:@Delete department', '4');
INSERT INTO `core_privilege` VALUES ('25', 'manage', 'admin', 'class', 'PrivilegeLabel:@Manage classes', '1');
INSERT INTO `core_privilege` VALUES ('26', 'add', 'admin', 'class', 'PrivilegeLabel:@Add new class', '2');
INSERT INTO `core_privilege` VALUES ('27', 'edit', 'admin', 'class', 'PrivilegeLabel:@Edit class', '3');
INSERT INTO `core_privilege` VALUES ('28', 'delete', 'admin', 'class', 'PrivilegeLabel:@Delete class', '4');
INSERT INTO `core_privilege` VALUES ('29', 'manage', 'admin', 'exam', 'PrivilegeLabel:@Manage exams', '1');
INSERT INTO `core_privilege` VALUES ('30', 'add', 'admin', 'exam', 'PrivilegeLabel:@Add new exam', '2');
INSERT INTO `core_privilege` VALUES ('31', 'edit', 'admin', 'exam', 'PrivilegeLabel:@Edit exam', '3');
INSERT INTO `core_privilege` VALUES ('32', 'delete', 'admin', 'exam', 'PrivilegeLabel:@Delete exam', '4');
INSERT INTO `core_privilege` VALUES ('33', 'manage', 'admin', 'question', 'PrivilegeLabel:@Manage questions', '1');
INSERT INTO `core_privilege` VALUES ('34', 'add', 'admin', 'question', 'PrivilegeLabel:@Add new question', '2');
INSERT INTO `core_privilege` VALUES ('35', 'edit', 'admin', 'question', 'PrivilegeLabel:@Edit question', '3');
INSERT INTO `core_privilege` VALUES ('36', 'delete', 'admin', 'question', 'PrivilegeLabel:@Delete question', '4');

-- ----------------------------
-- Table structure for core_question
-- ----------------------------
DROP TABLE IF EXISTS `core_question`;
CREATE TABLE `core_question` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_content` text COLLATE utf8_unicode_ci,
  `question_subject` int(11) DEFAULT '0',
  `question_chapter` int(11) NOT NULL DEFAULT '0',
  `question_level` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'EASY',
  `question_type` enum('ESSAY','TEST') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ESSAY',
  `question_creator` int(1) NOT NULL DEFAULT '0',
  `question_editor` int(1) NOT NULL DEFAULT '0',
  `question_status` tinyint(1) NOT NULL DEFAULT '0',
  `question_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_question
-- ----------------------------
INSERT INTO `core_question` VALUES ('1', 'AB', '2', '1', 'MEDIUM', 'TEST', '3', '3', '1', '2014-11-16 03:52:42');
INSERT INTO `core_question` VALUES ('2', 'CD', '2', '1', 'EASY', 'ESSAY', '3', '3', '1', null);
INSERT INTO `core_question` VALUES ('3', 'EF', '2', '1', 'EASY', 'ESSAY', '3', '3', '1', null);
INSERT INTO `core_question` VALUES ('4', '23432', '2', '2', 'EASY', 'TEST', '3', '0', '1', '2015-03-07 16:34:13');
INSERT INTO `core_question` VALUES ('5', '22adfa', '2', '3', 'EASY', 'TEST', '3', '0', '1', '2015-03-07 16:34:40');
INSERT INTO `core_question` VALUES ('11', 'Con người có nguồn gốc từ đâu?', '15', '15', 'EASY', 'TEST', '18', '0', '1', '2015-03-25 16:37:24');
INSERT INTO `core_question` VALUES ('12', 'Đặc điểm phân biệt chủ yếu giữa người tối cổ và\r\nngười tinh khôn là gì?', '15', '15', 'EASY', 'TEST', '18', '0', '1', '2015-03-25 16:38:41');
INSERT INTO `core_question` VALUES ('13', 'Lửa ra đời có ý nghĩa như thế nào trong xó hội\r\nbầy người nguyên thuỷ?', '15', '15', 'MEDIUM', 'TEST', '18', '18', '1', '2015-03-26 08:53:38');
INSERT INTO `core_question` VALUES ('14', 'Tại sao các công trình kiến trúc ở các quốc gia cổ đại phương Đông lại đồ sộ như vậy?', '15', '15', 'HARD', 'TEST', '18', '0', '1', '2015-03-26 08:55:15');
INSERT INTO `core_question` VALUES ('15', '&nbsp;Thông\r\nthường tệp văn bản MS Word có phần mở rộng là gì?', '9', '9', 'EASY', 'TEST', '12', '0', '1', '2015-03-26 08:59:35');
INSERT INTO `core_question` VALUES ('16', 'Trong\r\nMS Word, ta sử dụng tổ hợp phím nào để căn đều bên phải cho đoạn văn', '9', '9', 'MEDIUM', 'TEST', '12', '0', '1', '2015-03-26 09:00:42');
INSERT INTO `core_question` VALUES ('17', '&nbsp;&nbsp;Trong MS Word, ta làm cách nào để ngắt trang văn bản', '9', '9', 'HARD', 'TEST', '12', '0', '1', '2015-03-26 09:01:54');
INSERT INTO `core_question` VALUES ('18', 'Để hủy bỏ thao tác vừa thực hiện ta nhấn tổ hợp phím', '9', '9', 'EASY', 'TEST', '12', '0', '1', '2015-03-26 09:02:59');
INSERT INTO `core_question` VALUES ('19', 'Muốn chữ “Powerpoint” trong một văn bản định dạng thành\r\n“Powerpoint” ta:', '9', '9', 'MEDIUM', 'TEST', '12', '0', '1', '2015-03-26 09:04:32');
INSERT INTO `core_question` VALUES ('20', 'Giả sử tại ô D2 có công thức = B2*C2/100. Nếu sao chép\r\ncông thức đến ô G6 sẽ có công thức là&nbsp;', '9', '9', 'HARD', 'TEST', '12', '0', '1', '2015-03-26 09:05:33');
INSERT INTO `core_question` VALUES ('21', 'Trong khi làm việc với Excel, muốn di chuyển con trỏ ô\r\nvề ô A1, ta bấm?', '9', '9', 'HARD', 'TEST', '12', '0', '1', '2015-03-26 09:07:22');
INSERT INTO `core_question` VALUES ('22', 'Di sản văn hóa thế giới nào sau\r\nđây của Việt Nam không lọt vào xếp hạng các kì quan thiên nhiên thế giới hiện\r\nđại&nbsp;', '10', '10', 'MEDIUM', 'TEST', '13', '0', '1', '2015-03-26 09:10:23');
INSERT INTO `core_question` VALUES ('23', 'Nơi nào trên Trái Đất có 6 tháng là ngày, 6 tháng là đêm', '10', '10', 'EASY', 'TEST', '13', '0', '1', '2015-03-26 09:11:56');
INSERT INTO `core_question` VALUES ('24', 'Giờ quốc tế được gọi là:', '10', '10', 'MEDIUM', 'TEST', '13', '0', '1', '2015-03-26 09:12:51');
INSERT INTO `core_question` VALUES ('25', 'Trái đất là một hành tinh trong hệ mặt trời nằm\r\nở vị trí thứ mấy tính từ Mặt Trời', '10', '10', 'MEDIUM', 'TEST', '13', '13', '1', '2015-03-26 09:13:32');
INSERT INTO `core_question` VALUES ('26', 'Sơn dầu là chất liệu vẽ được phát\r\nhiện ở phương tây từ thời phục hung nhưng xuất hiện ở VN vào năm', '12', '12', 'HARD', 'TEST', '15', '0', '1', '2015-03-26 10:05:39');
INSERT INTO `core_question` VALUES ('27', 'Khi trang trí hội trường tùy\r\nthuộc vòa nội dung buổi lễ cần có', '12', '12', 'EASY', 'TEST', '15', '0', '1', '2015-03-26 10:07:13');
INSERT INTO `core_question` VALUES ('28', 'Kiến trúc đình làng Việt nam là\r\nthành tựu đặc sắc trong nghệ thuật kiến trúc', '12', '12', 'MEDIUM', 'TEST', '15', '0', '1', '2015-03-26 10:08:07');
INSERT INTO `core_question` VALUES ('29', 'Để tiến hành vẽ một bức tranh đề\r\ntài thực hiện theo các bước nào', '12', '12', 'HARD', 'TEST', '15', '0', '1', '2015-03-26 10:09:00');
INSERT INTO `core_question` VALUES ('30', 'Nhà Rông Tây Nguyên có những đặc\r\nđiểm nào sau đây', '12', '12', 'HARD', 'TEST', '15', '0', '1', '2015-03-26 10:09:43');
INSERT INTO `core_question` VALUES ('31', 'Tác phẩm chơi ô ăn quan của họa\r\nsĩ nào', '12', '12', 'HARD', 'TEST', '15', '0', '1', '2015-03-26 10:10:43');
INSERT INTO `core_question` VALUES ('32', 'Bức tranh thiếu nữ bên hoa huệ là\r\ncủa tô ngọc vân vẽ trên chất liệu gì', '12', '12', 'HARD', 'TEST', '15', '0', '1', '2015-03-26 10:11:35');
INSERT INTO `core_question` VALUES ('33', 'Hình nốt trắng chấm dôi trong nhịp\r\n¾ có độ ngân là', '13', '13', 'EASY', 'TEST', '16', '0', '1', '2015-03-26 10:13:53');
INSERT INTO `core_question` VALUES ('34', 'Nhạc sĩ thiên tài Mô – da là\r\nngười nước nào', '13', '13', 'MEDIUM', 'TEST', '16', '0', '1', '2015-03-26 10:14:50');
INSERT INTO `core_question` VALUES ('35', 'Trong bản nhạc, dấu nối dung để', '13', '13', 'HARD', 'TEST', '16', '0', '1', '2015-03-26 10:15:36');
INSERT INTO `core_question` VALUES ('36', 'Bài hát Ai yêu Bác Hồ Chí Minh\r\nhơn thiếu niên nhi đồng là sáng tác của nhạc sĩ nào', '13', '13', 'MEDIUM', 'TEST', '16', '0', '1', '2015-03-26 10:16:56');
INSERT INTO `core_question` VALUES ('37', 'Câu hát Mẹ lên rẫy… có trong bài\r\nhát nào?', '13', '13', 'EASY', 'TEST', '16', '0', '1', '2015-03-26 10:19:35');
INSERT INTO `core_question` VALUES ('38', 'Quyển vật lý học đầu tiên trong\r\nlịch sử loài người do ai viết', '14', '14', 'MEDIUM', 'TEST', '17', '0', '1', '2015-03-26 10:26:29');
INSERT INTO `core_question` VALUES ('39', 'Nhà bác học Copernic nổi tiếng\r\nvới thuyết nào', '14', '14', 'EASY', 'TEST', '17', '0', '1', '2015-03-26 10:27:08');
INSERT INTO `core_question` VALUES ('40', 'Chùm sáng hội tụ là', '14', '14', 'MEDIUM', 'TEST', '17', '0', '1', '2015-03-26 10:28:07');
INSERT INTO `core_question` VALUES ('41', 'Một thành phố được cấp điện từ\r\nmột nhà máy thủy điện, chế độ làm việc của nhà máy cần thay đổi như thế nào\r\ntrong các giờ cao điểm', '14', '14', 'MEDIUM', 'TEST', '17', '0', '1', '2015-03-26 10:42:31');
INSERT INTO `core_question` VALUES ('42', 'Tai người có thể cảm thụ được\r\nnhững dao động có tần số nằm trong giới hạn nào', '14', '14', 'MEDIUM', 'TEST', '17', '0', '1', '2015-03-26 10:43:19');
INSERT INTO `core_question` VALUES ('43', 'Vì sao mỗi buổi bình minh người\r\nta gọi nó là sao mai, buổi hoàng hôn người ta gọi đó là sao hôm? Đó là hành\r\ntinh nào và ở vị trí thứ mấy trong 8 hành tinh', '14', '14', 'EASY', 'TEST', '17', '0', '1', '2015-03-26 10:43:56');
INSERT INTO `core_question` VALUES ('44', 'Nguồn cung cấp khoáng cho thực\r\nvật', '16', '16', 'MEDIUM', 'TEST', '19', '0', '1', '2015-03-26 11:03:55');
INSERT INTO `core_question` VALUES ('45', 'Chúng ta tiết nước bọt ra trung\r\nbình mỗi ngày mấy lít', '16', '16', 'MEDIUM', 'TEST', '19', '0', '1', '2015-03-26 11:04:45');
INSERT INTO `core_question` VALUES ('46', 'Lông mi chớp bao nhiêu lần mỗi\r\nngày', '16', '16', 'HARD', 'TEST', '19', '0', '1', '2015-03-26 11:06:32');
INSERT INTO `core_question` VALUES ('47', 'Gan tạo ra bao nhiêu lít mật mỗi\r\nngày', '16', '16', 'MEDIUM', 'TEST', '19', '0', '1', '2015-03-26 11:07:25');
INSERT INTO `core_question` VALUES ('48', 'Loài động vật nào to nhất', '16', '16', 'EASY', 'TEST', '19', '0', '1', '2015-03-26 14:01:30');
INSERT INTO `core_question` VALUES ('49', 'Ở loài nhện, sau khi giao phối\r\nthì chuyện gì xảy ra', '16', '16', 'EASY', 'TEST', '19', '0', '1', '2015-03-26 14:02:16');
INSERT INTO `core_question` VALUES ('50', 'Nguyên tố nào phổ biến nhất ngoài\r\ntrái đất', '17', '17', 'EASY', 'TEST', '20', '0', '1', '2015-03-26 14:13:16');
INSERT INTO `core_question` VALUES ('51', 'Kim loại nào dẻo nhất', '17', '17', 'MEDIUM', 'TEST', '20', '0', '1', '2015-03-26 14:13:57');
INSERT INTO `core_question` VALUES ('52', 'Khi giặt quần áo nilon, len, tơ\r\ntằm, ta giặt', '17', '17', 'HARD', 'TEST', '20', '0', '1', '2015-03-26 14:14:50');
INSERT INTO `core_question` VALUES ('53', 'Chọn câu đúng', '17', '17', 'HARD', 'TEST', '20', '0', '1', '2015-03-26 14:15:42');
INSERT INTO `core_question` VALUES ('54', 'Hợp chất hữu cơ Y làm cho quỳ tím\r\nchuyển sang màu đỏ, tác dụng được với một số kim loại, oxit bazo, bazo, muối\r\ncacbonat, vậy y có chứa nhóm:', '17', '17', 'EASY', 'TEST', '20', '0', '1', '2015-03-26 14:16:28');
INSERT INTO `core_question` VALUES ('55', 'Cho 0,1 mol Na vào bình chứa 0,4\r\nmol C2H5OH. Thể tích H2 sinh ra ở ĐKTC là', '17', '17', 'MEDIUM', 'TEST', '20', '0', '1', '2015-03-26 14:17:11');
INSERT INTO `core_question` VALUES ('56', 'Kí hiệu hóa học của nguyên tử\r\nthủy ngân là', '17', '17', 'EASY', 'TEST', '20', '0', '1', '2015-03-26 14:17:59');
INSERT INTO `core_question` VALUES ('57', 'Dãy công thức nào toàn công thức\r\nviết đúng trong các dãy sau', '17', '17', 'MEDIUM', 'TEST', '20', '0', '1', '2015-03-26 14:19:07');
INSERT INTO `core_question` VALUES ('58', 'Tệ nạn xã hội bao gồm những hành\r\nvi nào sau đây', '18', '18', 'MEDIUM', 'TEST', '21', '0', '1', '2015-03-26 14:21:39');
INSERT INTO `core_question` VALUES ('59', 'Tình huống nào sau đây vi phạm tệ nạn xã hội', '18', '18', 'MEDIUM', 'TEST', '21', '0', '1', '2015-03-26 14:22:43');
INSERT INTO `core_question` VALUES ('60', 'Em không đồng ý với ý kiến nào sau đây', '18', '18', 'MEDIUM', 'TEST', '21', '0', '1', '2015-03-26 14:26:11');
INSERT INTO `core_question` VALUES ('61', 'HIV không lây qua con đường nào sau đây', '18', '18', 'EASY', 'TEST', '21', '0', '1', '2015-03-26 14:26:55');
INSERT INTO `core_question` VALUES ('62', 'Hành vi nào sau đây vi phạm quy định về phòng ngừa tai nạn\r\nvũ khí, cháy, nổ và các chất độc hại', '18', '18', 'MEDIUM', 'TEST', '21', '0', '1', '2015-03-26 14:27:47');
INSERT INTO `core_question` VALUES ('63', 'Tôn trọng tài sản của người khác thể hiện phẩm chất đạo đức\r\nnào trong các phẩm chất sau', '18', '18', 'HARD', 'TEST', '21', '0', '1', '2015-03-26 14:28:32');
INSERT INTO `core_question` VALUES ('64', 'Hành vi nào sau đây thể hiện long yêu hòa bình', '18', '18', 'EASY', 'TEST', '21', '0', '1', '2015-03-26 14:29:18');
INSERT INTO `core_question` VALUES ('65', 'Em tán thành với ý kiến nào dưới đây nói về chí công vô tư', '18', '18', 'EASY', 'TEST', '21', '0', '1', '2015-03-26 14:30:01');
INSERT INTO `core_question` VALUES ('66', 'Câu ghép là câu:', '19', '19', 'MEDIUM', 'TEST', '22', '0', '1', '2015-03-26 14:32:50');
INSERT INTO `core_question` VALUES ('67', 'Dấu ngoặc kép trong câu in đậm: “\r\nLão Hạc” là một truyện ngắn xuất sắc của Nam cao viết về người nông dân. Được\r\ndung để đánh dấu', '19', '19', 'MEDIUM', 'TEST', '22', '0', '1', '2015-03-26 14:33:28');
INSERT INTO `core_question` VALUES ('68', 'Câu không sử dụng cách nói giảm\r\nnói tránh là', '19', '19', 'EASY', 'TEST', '22', '0', '1', '2015-03-26 14:34:11');
INSERT INTO `core_question` VALUES ('69', 'Câu thành ngữ có sử dụng biện pháp\r\nnói quá là', '19', '19', 'EASY', 'TEST', '22', '0', '1', '2015-03-26 14:34:57');
INSERT INTO `core_question` VALUES ('70', 'Từ nào dưới đây không phải là từ\r\ntượng hình?', '19', '19', 'MEDIUM', 'TEST', '22', '0', '1', '2015-03-26 14:39:52');
INSERT INTO `core_question` VALUES ('71', 'Tóm tắt văn bản tự sự là gì', '19', '19', 'MEDIUM', 'TEST', '22', '0', '1', '2015-03-26 14:40:43');
INSERT INTO `core_question` VALUES ('72', 'Choose the word that has the\r\nunderlined part pronounced differently from the others:', '20', '20', 'EASY', 'TEST', '23', '0', '1', '2015-03-26 14:45:17');
INSERT INTO `core_question` VALUES ('73', 'Hãy chọn từ saiHow far is it from\r\nyour house in Long Xuyen city?\r\n\r\nA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B&nbsp;&nbsp;&nbsp;\r\nC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;D&nbsp;&nbsp;', '20', '20', 'MEDIUM', 'TEST', '23', '0', '1', '2015-03-26 14:46:59');
INSERT INTO `core_question` VALUES ('74', 'Hãy chọn từ saiDo you often plays\r\ncatch at recess?\r\n\r\nA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;\r\nD', '20', '20', 'MEDIUM', 'TEST', '23', '0', '1', '2015-03-26 14:47:46');
INSERT INTO `core_question` VALUES ('75', 'Choose the word whose main stress\r\nis placed differently from the others', '20', '20', 'MEDIUM', 'TEST', '23', '0', '1', '2015-03-26 14:48:26');
INSERT INTO `core_question` VALUES ('76', 'Vietnamese language is different\r\n… English language', '20', '20', 'EASY', 'TEST', '23', '0', '1', '2015-03-26 14:49:03');
INSERT INTO `core_question` VALUES ('77', 'Nam’s father … in this company\r\nfor 20 years', '20', '20', 'MEDIUM', 'TEST', '23', '0', '1', '2015-03-26 14:49:41');
INSERT INTO `core_question` VALUES ('78', 'He used to … the guitar when he …\r\na student', '20', '20', 'HARD', 'TEST', '23', '0', '1', '2015-03-26 14:50:26');
INSERT INTO `core_question` VALUES ('79', 'Yếu tố ảnh hưởng đến sự sinh\r\ntrưởng và phát triển của vật nuôi là', '21', '21', 'MEDIUM', 'TEST', '25', '0', '1', '2015-03-26 14:53:03');
INSERT INTO `core_question` VALUES ('80', 'Bột cá là thức ăn có nguồn gốc\r\ntừ', '21', '21', 'EASY', 'TEST', '25', '0', '1', '2015-03-26 14:53:55');
INSERT INTO `core_question` VALUES ('81', 'Giống vật nuôi quyết định đến', '21', '21', 'MEDIUM', 'TEST', '25', '0', '1', '2015-03-26 14:54:36');
INSERT INTO `core_question` VALUES ('82', 'Qua đường tiêu hóa của vật nuôi\r\nprotein được hấp thụ dưới dạng', '21', '21', 'HARD', 'TEST', '25', '0', '1', '2015-03-26 14:55:18');
INSERT INTO `core_question` VALUES ('83', 'Số Pi được tính bằng tỉ số giữa', '7', '7', 'MEDIUM', 'TEST', '24', '0', '1', '2015-03-26 15:11:08');
INSERT INTO `core_question` VALUES ('84', 'Trong một tam giác, đường nào\r\nchia tam giác thành hai miền có diện tích bằng nhau', '7', '7', 'HARD', 'TEST', '24', '0', '1', '2015-03-26 15:17:37');
INSERT INTO `core_question` VALUES ('85', 'Số 0 do nước nào phát minh', '7', '7', 'EASY', 'TEST', '24', '0', '1', '2015-03-26 15:18:22');
INSERT INTO `core_question` VALUES ('86', 'Giá trị của biểu thức 36.32\r\nbằng', '7', '7', 'MEDIUM', 'TEST', '24', '0', '1', '2015-03-26 15:19:06');
INSERT INTO `core_question` VALUES ('87', '5m dây động nặng 40g. Hỏi 8 m\r\ndây đồng nặng bao nhiêu', '7', '8', 'MEDIUM', 'TEST', '24', '0', '1', '2015-03-26 15:20:44');
INSERT INTO `core_question` VALUES ('88', 'Điểm nào thuộc đồ thị của hàm số\r\ny=2x trong các điểm sau:', '7', '8', 'HARD', 'TEST', '24', '0', '1', '2015-03-26 15:21:45');
INSERT INTO `core_question` VALUES ('89', 'Đường thẳng d là đường trung\r\ntrực của AB nếu', '7', '8', 'HARD', 'TEST', '24', '0', '1', '2015-03-26 15:23:45');
INSERT INTO `core_question` VALUES ('90', 'Cho tam giác ABC vuông tại A thì tổng các góc sau có giá trị nào đúng', '7', '8', 'HARD', 'TEST', '24', '0', '1', '2015-03-26 15:25:16');
INSERT INTO `core_question` VALUES ('91', 'Sức bền là gì?', '11', '11', 'MEDIUM', 'TEST', '14', '0', '1', '2015-03-26 15:37:36');
INSERT INTO `core_question` VALUES ('92', 'Nguyên nhân cơ bản để xảy ra chấn thương trong tập luyện TDTT là ?', '11', '11', 'MEDIUM', 'TEST', '14', '0', '1', '2015-03-26 15:39:30');
INSERT INTO `core_question` VALUES ('93', 'Để tiến hành tập luyện cho tốt, trước khi tập các em nên ăn uống như thế nào', '11', '11', 'EASY', 'TEST', '14', '0', '1', '2015-03-26 15:40:43');
INSERT INTO `core_question` VALUES ('94', 'Trong quá trình tập luyện hoặc thi đấu, nếu thấy sức khỏe không bình thường em cần phải làm gì?', '11', '11', 'MEDIUM', 'TEST', '14', '0', '1', '2015-03-26 15:42:44');
INSERT INTO `core_question` VALUES ('95', 'Trường hợp đang chạy đều, em muốn dừng lại thì dùng khẩu lệnh nào?', '11', '11', 'EASY', 'TEST', '14', '0', '1', '2015-03-26 15:44:00');
INSERT INTO `core_question` VALUES ('96', 'Môn thể thao nào được coi là môn thể thao vua?', '11', '11', 'HARD', 'TEST', '14', '0', '1', '2015-03-26 15:48:21');
INSERT INTO `core_question` VALUES ('97', 'Bàn cờ vua có bao nhiêu quân cờ', '11', '11', 'MEDIUM', 'TEST', '14', '0', '1', '2015-03-26 15:49:12');
INSERT INTO `core_question` VALUES ('98', 'Trong một tiết học thể dục chúng ta không thể thiếu nội dung gì', '11', '11', 'EASY', 'TEST', '14', '0', '1', '2015-03-26 15:50:20');
INSERT INTO `core_question` VALUES ('99', 'Mỗi đội bóng chuyền thi đấu trên sân có bao nhiêu cầu thủ', '11', '11', 'HARD', 'TEST', '14', '0', '1', '2015-03-26 15:51:00');
INSERT INTO `core_question` VALUES ('100', 'Mỗi trận bóng đá có bao nhiêu hiệp chính', '11', '11', 'EASY', 'TEST', '14', '0', '1', '2015-03-26 15:51:39');
INSERT INTO `core_question` VALUES ('101', 'Môn thể thao nào được coi là môn thể thao nữ hoàng', '11', '11', 'MEDIUM', 'TEST', '14', '0', '1', '2015-03-26 15:52:32');
INSERT INTO `core_question` VALUES ('102', 'Môn thể thao nào vận động viên không được đi giày để thi đấu?', '11', '11', 'EASY', 'TEST', '14', '0', '1', '2015-03-26 15:53:46');
INSERT INTO `core_question` VALUES ('105', 'Lửa ra đời có ý nghĩa như thế nào trong xã hội bầy người nguyên thủy?', '22', '22', 'EASY', 'TEST', '30', '0', '1', '2015-03-30 16:24:56');
INSERT INTO `core_question` VALUES ('106', 'Tại sao các công trình kiến trúc ở các quốc gia cổ đại phương Đông lại đồ sộ như vậy?', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:28:46');
INSERT INTO `core_question` VALUES ('107', 'Di sản văn hóa thế giới nào sau\r\nđây của Việt Nam không lọt vào xếp hạng các kì quan thiên nhiên thế giới hiện\r\nđại', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:29:45');
INSERT INTO `core_question` VALUES ('108', 'Giờ quốc tế được gọi là:', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:30:28');
INSERT INTO `core_question` VALUES ('109', 'Số Pi được tính bằng tỉ số giữa', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:31:49');
INSERT INTO `core_question` VALUES ('110', 'Trong một tam giác, đường nào\r\nchia tam giác thành hai miền có diện tích bằng nhau', '22', '22', 'HARD', 'TEST', '30', '0', '1', '2015-03-30 16:32:35');
INSERT INTO `core_question` VALUES ('111', 'Số 0 do nước nào phát minh', '22', '22', 'EASY', 'TEST', '30', '0', '1', '2015-03-30 16:33:18');
INSERT INTO `core_question` VALUES ('112', 'Nguyên tố nào phổ biến nhất ngoài\r\ntrái đất', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:35:06');
INSERT INTO `core_question` VALUES ('113', 'Kim loại nào dẻo nhất', '22', '22', 'HARD', 'TEST', '30', '0', '1', '2015-03-30 16:35:54');
INSERT INTO `core_question` VALUES ('114', 'Ở loài nhện, sau khi giao phối thì\r\nchuyện gì xảy ra', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:37:04');
INSERT INTO `core_question` VALUES ('115', 'Chúng ta tiết nước bọt ra trung\r\nbình mỗi ngày mấy lít', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:38:29');
INSERT INTO `core_question` VALUES ('116', 'Quyển vật lý học đầu tiên trong\r\nlịch sử loài người do ai viết', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:39:19');
INSERT INTO `core_question` VALUES ('117', 'Vì sao mỗi buổi bình minh người\r\nta gọi nó là sao mai, buổi hoàng hôn người ta gọi đó là sao hôm? Đó là hành\r\ntinh nào và ở vị trí thứ mấy trong 8 hành tinh', '22', '22', 'HARD', 'TEST', '30', '0', '1', '2015-03-30 16:41:47');
INSERT INTO `core_question` VALUES ('118', 'Nhạc sĩ thiên tài Mô – da là\r\nngười nước nào', '22', '22', 'HARD', 'TEST', '30', '0', '1', '2015-03-30 16:43:07');
INSERT INTO `core_question` VALUES ('119', 'Sơn dầu là chất liệu vẽ được phát\r\nhiện ở phương tây từ thời phục hung nhưng xuất hiện ở VN vào năm', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:44:01');
INSERT INTO `core_question` VALUES ('120', 'Bức tranh thiếu nữ bên hoa huệ là\r\ncủa tô ngọc vân vẽ trên chất liệu gì', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:45:51');
INSERT INTO `core_question` VALUES ('121', 'Yếu tố ảnh hưởng đến sự sinh\r\ntrưởng và phát triển của vật nuôi là', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:46:59');
INSERT INTO `core_question` VALUES ('122', 'Tệ nạn xã hội bao gồm những hành\r\nvi nào sau đây', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:48:35');
INSERT INTO `core_question` VALUES ('123', 'HIV không lây qua con đường nào\r\nsau đây', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:51:12');
INSERT INTO `core_question` VALUES ('124', 'Câu không sử dụng cách nói giảm nói tránh là\r\n\r\n', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:52:37');
INSERT INTO `core_question` VALUES ('125', 'Câu thành ngữ có sử dụng biện pháp\r\nnói quá là', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:53:35');
INSERT INTO `core_question` VALUES ('126', 'Từ nào dưới đây không phải là từ tượng hình?\r\n\r\n', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:55:05');
INSERT INTO `core_question` VALUES ('127', 'Trong MS Word, ta sử dụng tổ hợp\r\nphím nào để căn đều bên phải cho đoạn văn', '22', '22', 'HARD', 'TEST', '30', '0', '1', '2015-03-30 16:56:02');
INSERT INTO `core_question` VALUES ('128', 'Để hủy bỏ thao tác vừa thực hiện\r\nta nhấn tổ hợp phím', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:57:13');
INSERT INTO `core_question` VALUES ('129', 'Vietnamese language is different\r\n… English language', '22', '22', 'MEDIUM', 'TEST', '30', '0', '1', '2015-03-30 16:58:20');
INSERT INTO `core_question` VALUES ('130', 'He used to … the guitar when he\r\n… a student', '22', '22', 'HARD', 'TEST', '30', '0', '1', '2015-03-30 16:59:14');
INSERT INTO `core_question` VALUES ('131', 'Bài hát nào dưới đây do Sơn Tùng MTP trình bày', '24', '24', 'EASY', 'TEST', '32', '0', '1', '2015-03-30 17:46:49');
INSERT INTO `core_question` VALUES ('132', 'Sơn Tùng MPT hát ca khúc nào?', '25', '26', 'EASY', 'TEST', '34', '0', '1', '2015-03-30 18:24:15');
INSERT INTO `core_question` VALUES ('133', 'faw', '11', '11', 'EASY', 'TEST', '14', '14', '1', '2015-05-06 09:50:36');
INSERT INTO `core_question` VALUES ('134', 'khoi', '23', '23', 'EASY', 'TEST', '38', '0', '1', '2015-05-06 10:11:17');
INSERT INTO `core_question` VALUES ('135', 'Hình ảnh này có ý nghĩa gì?', '24', '24', 'EASY', 'TEST', '40', '40', '1', '2015-05-06 10:57:03');
INSERT INTO `core_question` VALUES ('136', '<p>khoa<img src=\"http://localhost/Quiz/public/uploads/uploadify/2015-05-14/1455548891706d4anh qua trung thu 2.jpg\" [removed] 269px;\"></p>', '11', '11', 'EASY', 'TEST', '14', '0', '1', '2015-05-14 18:36:37');
INSERT INTO `core_question` VALUES ('137', '<p></p>&lt;audio controls=\"\" src=\"http://localhost/Quiz/public/uploads/uploadify/2015-05-14/1455548e8adb41dSay You Do - Tien Tien [MP3 128kbps].mp3\" width=\"640\" height=\"360\" frameborder=\"0\"&gt;&lt;/audio>', '11', '11', 'MEDIUM', 'TEST', '14', '0', '1', '2015-05-14 19:05:09');
INSERT INTO `core_question` VALUES ('138', 'dsaddsadsa', '8', '4', 'EASY', 'TEST', '2', '0', '1', '2015-06-23 17:48:53');
INSERT INTO `core_question` VALUES ('139', '<p><br><img src=\"http://192.168.1.85/Quiz/public/uploads/uploadify/2015-05-14/14555488bb17239be lam banh.jpg\" [removed]=\"width: 525px;\"></p>', '7', '7', 'EASY', 'TEST', '2', '0', '1', '2015-06-23 17:57:16');

-- ----------------------------
-- Table structure for core_question_level
-- ----------------------------
DROP TABLE IF EXISTS `core_question_level`;
CREATE TABLE `core_question_level` (
  `question_level_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_level_name` varchar(255) NOT NULL,
  `question_level_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `question_level_status` tinyint(1) NOT NULL DEFAULT '0',
  `question_level_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`question_level_id`),
  UNIQUE KEY `question_level_code_index` (`question_level_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_question_level
-- ----------------------------
INSERT INTO `core_question_level` VALUES ('1', 'Dễ', 'EASY', '1', '2014-11-19 02:44:47');
INSERT INTO `core_question_level` VALUES ('2', 'Trung bình', 'MEDIUM', '1', '2014-11-19 02:44:47');
INSERT INTO `core_question_level` VALUES ('3', 'Khó', 'HARD', '1', '2014-11-19 02:44:47');

-- ----------------------------
-- Table structure for core_resource
-- ----------------------------
DROP TABLE IF EXISTS `core_resource`;
CREATE TABLE `core_resource` (
  `resource_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resource_module` varchar(50) NOT NULL,
  `resource_controller` varchar(255) NOT NULL,
  `resource_description` varchar(255) DEFAULT NULL,
  `resource_order` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`resource_id`),
  UNIQUE KEY `module_controller_index` (`resource_module`,`resource_controller`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_resource
-- ----------------------------
INSERT INTO `core_resource` VALUES ('1', 'admin', 'teacher', 'Manage teachers', '0');
INSERT INTO `core_resource` VALUES ('5', 'admin', 'student', 'Manage students', '0');

-- ----------------------------
-- Table structure for core_role
-- ----------------------------
DROP TABLE IF EXISTS `core_role`;
CREATE TABLE `core_role` (
  `role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_code` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_status` tinyint(1) DEFAULT '0',
  `role_date_created` datetime NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_code_index` (`role_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_role
-- ----------------------------
INSERT INTO `core_role` VALUES ('2', 'user', 'Thành viên', '1', '0000-00-00 00:00:00');
INSERT INTO `core_role` VALUES ('4', 'student', 'Sinh viên', '1', '0000-00-00 00:00:00');
INSERT INTO `core_role` VALUES ('5', 'teacher', 'Giáo viên', '1', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for core_session
-- ----------------------------
DROP TABLE IF EXISTS `core_session`;
CREATE TABLE `core_session` (
  `session_id` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `session_modified` int(11) DEFAULT NULL,
  `session_lifetime` int(11) DEFAULT NULL,
  `session_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_session
-- ----------------------------
INSERT INTO `core_session` VALUES ('guv6e1a47va89m49u9rn7pav87', '1453154861', '864000', 'Zend_Auth|a:1:{s:7:\"storage\";a:5:{s:4:\"user\";O:19:\"Lumia_Auth_Identity\":1:{s:8:\"\0*\0_data\";a:10:{s:7:\"user_id\";s:1:\"2\";s:9:\"user_name\";s:10:\"admin_demo\";s:13:\"user_fullname\";N;s:13:\"user_password\";s:32:\"5ccfd74179f21a612101940c1df42519\";s:9:\"user_salt\";s:32:\"snv3yQ1WwNWBzfQbfMJBixO5kYvZgVL9\";s:9:\"user_role\";s:13:\"administrator\";s:10:\"user_email\";s:15:\"admin@gmail.com\";s:11:\"user_status\";s:1:\"1\";s:17:\"user_date_created\";s:19:\"2014-09-16 11:22:55\";s:17:\"user_date_updated\";s:19:\"2014-11-15 07:22:38\";}}s:10:\"permission\";O:19:\"Lumia_Auth_Identity\":1:{s:8:\"\0*\0_data\";a:0:{}}s:10:\"navigation\";O:19:\"Lumia_Auth_Identity\":1:{s:8:\"\0*\0_data\";a:37:{i:0;a:10:{s:13:\"navigation_id\";s:1:\"1\";s:15:\"navigation_name\";s:24:\"NavbarLeft:@Manage exams\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:1:\"1\";s:16:\"navigation_right\";s:1:\"8\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:02:15\";s:5:\"depth\";s:1:\"0\";}i:1;a:10:{s:13:\"navigation_id\";s:1:\"2\";s:15:\"navigation_name\";s:21:\"NavbarLeft:@All exams\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:1:\"2\";s:16:\"navigation_right\";s:1:\"3\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:10:\"admin/exam\";s:20:\"navigation_privilege\";s:17:\"admin@exam@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:04:45\";s:5:\"depth\";s:1:\"1\";}i:2;a:10:{s:13:\"navigation_id\";s:1:\"3\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:1:\"4\";s:16:\"navigation_right\";s:1:\"5\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:14:\"admin/exam/add\";s:20:\"navigation_privilege\";s:14:\"admin@exam@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:05:25\";s:5:\"depth\";s:1:\"1\";}i:3;a:10:{s:13:\"navigation_id\";s:1:\"8\";s:15:\"navigation_name\";s:23:\"NavbarLeft:@Exam grades\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:1:\"6\";s:16:\"navigation_right\";s:1:\"7\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:11:\"admin/score\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:07:43\";s:5:\"depth\";s:1:\"1\";}i:4;a:10:{s:13:\"navigation_id\";s:1:\"4\";s:15:\"navigation_name\";s:28:\"NavbarLeft:@Manage questions\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:1:\"9\";s:16:\"navigation_right\";s:2:\"14\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:06:00\";s:5:\"depth\";s:1:\"0\";}i:5;a:10:{s:13:\"navigation_id\";s:1:\"5\";s:15:\"navigation_name\";s:25:\"NavbarLeft:@All questions\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"10\";s:16:\"navigation_right\";s:2:\"11\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:14:\"admin/question\";s:20:\"navigation_privilege\";s:21:\"admin@question@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:06:18\";s:5:\"depth\";s:1:\"1\";}i:6;a:10:{s:13:\"navigation_id\";s:1:\"6\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"12\";s:16:\"navigation_right\";s:2:\"13\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:18:\"admin/question/add\";s:20:\"navigation_privilege\";s:18:\"admin@question@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:06:42\";s:5:\"depth\";s:1:\"1\";}i:7;a:10:{s:13:\"navigation_id\";s:1:\"9\";s:15:\"navigation_name\";s:24:\"NavbarLeft:@Exam reports\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"15\";s:16:\"navigation_right\";s:2:\"18\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:08:10\";s:5:\"depth\";s:1:\"0\";}i:8;a:10:{s:13:\"navigation_id\";s:2:\"10\";s:15:\"navigation_name\";s:23:\"NavbarLeft:@All reports\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"16\";s:16:\"navigation_right\";s:2:\"17\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:17:\"admin/exam/report\";s:20:\"navigation_privilege\";s:17:\"admin@exam@report\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:10:01\";s:5:\"depth\";s:1:\"1\";}i:9;a:10:{s:13:\"navigation_id\";s:2:\"11\";s:15:\"navigation_name\";s:26:\"NavbarLeft:@Manage classes\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"19\";s:16:\"navigation_right\";s:2:\"24\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:11:38\";s:5:\"depth\";s:1:\"0\";}i:10;a:10:{s:13:\"navigation_id\";s:2:\"12\";s:15:\"navigation_name\";s:23:\"NavbarLeft:@All classes\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"20\";s:16:\"navigation_right\";s:2:\"21\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:13:\"admin/classes\";s:20:\"navigation_privilege\";s:20:\"admin@classes@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:12:21\";s:5:\"depth\";s:1:\"1\";}i:11;a:10:{s:13:\"navigation_id\";s:2:\"13\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"22\";s:16:\"navigation_right\";s:2:\"23\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:17:\"admin/classes/add\";s:20:\"navigation_privilege\";s:17:\"admin@classes@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:12:42\";s:5:\"depth\";s:1:\"1\";}i:12;a:10:{s:13:\"navigation_id\";s:2:\"14\";s:15:\"navigation_name\";s:30:\"NavbarLeft:@Manage departments\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"25\";s:16:\"navigation_right\";s:2:\"30\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:13:07\";s:5:\"depth\";s:1:\"0\";}i:13;a:10:{s:13:\"navigation_id\";s:2:\"15\";s:15:\"navigation_name\";s:27:\"NavbarLeft:@All departments\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"26\";s:16:\"navigation_right\";s:2:\"27\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:16:\"admin/department\";s:20:\"navigation_privilege\";s:23:\"admin@department@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:13:24\";s:5:\"depth\";s:1:\"1\";}i:14;a:10:{s:13:\"navigation_id\";s:2:\"16\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"28\";s:16:\"navigation_right\";s:2:\"29\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:20:\"admin/department/add\";s:20:\"navigation_privilege\";s:20:\"admin@department@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:13:35\";s:5:\"depth\";s:1:\"1\";}i:15;a:10:{s:13:\"navigation_id\";s:2:\"17\";s:15:\"navigation_name\";s:27:\"NavbarLeft:@Manage subjects\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"31\";s:16:\"navigation_right\";s:2:\"36\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:14:03\";s:5:\"depth\";s:1:\"0\";}i:16;a:10:{s:13:\"navigation_id\";s:2:\"18\";s:15:\"navigation_name\";s:24:\"NavbarLeft:@All subjects\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"32\";s:16:\"navigation_right\";s:2:\"33\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:13:\"admin/subject\";s:20:\"navigation_privilege\";s:20:\"admin@subject@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:14:21\";s:5:\"depth\";s:1:\"1\";}i:17;a:10:{s:13:\"navigation_id\";s:2:\"19\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"34\";s:16:\"navigation_right\";s:2:\"35\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:17:\"admin/subject/add\";s:20:\"navigation_privilege\";s:17:\"admin@subject@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:14:31\";s:5:\"depth\";s:1:\"1\";}i:18;a:10:{s:13:\"navigation_id\";s:2:\"20\";s:15:\"navigation_name\";s:27:\"NavbarLeft:@Manage students\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"37\";s:16:\"navigation_right\";s:2:\"42\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:14:52\";s:5:\"depth\";s:1:\"0\";}i:19;a:10:{s:13:\"navigation_id\";s:2:\"21\";s:15:\"navigation_name\";s:24:\"NavbarLeft:@All students\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"38\";s:16:\"navigation_right\";s:2:\"39\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:13:\"admin/student\";s:20:\"navigation_privilege\";s:20:\"admin@student@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:15:21\";s:5:\"depth\";s:1:\"1\";}i:20;a:10:{s:13:\"navigation_id\";s:2:\"22\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"40\";s:16:\"navigation_right\";s:2:\"41\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:17:\"admin/student/add\";s:20:\"navigation_privilege\";s:17:\"admin@student@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:15:33\";s:5:\"depth\";s:1:\"1\";}i:21;a:10:{s:13:\"navigation_id\";s:2:\"23\";s:15:\"navigation_name\";s:27:\"NavbarLeft:@Manage teachers\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"43\";s:16:\"navigation_right\";s:2:\"48\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:16:30\";s:5:\"depth\";s:1:\"0\";}i:22;a:10:{s:13:\"navigation_id\";s:2:\"24\";s:15:\"navigation_name\";s:24:\"NavbarLeft:@All teachers\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"44\";s:16:\"navigation_right\";s:2:\"45\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:13:\"admin/teacher\";s:20:\"navigation_privilege\";s:20:\"admin@teacher@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:17:46\";s:5:\"depth\";s:1:\"1\";}i:23;a:10:{s:13:\"navigation_id\";s:2:\"25\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"46\";s:16:\"navigation_right\";s:2:\"47\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:17:\"admin/teacher/add\";s:20:\"navigation_privilege\";s:17:\"admin@teacher@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:17:47\";s:5:\"depth\";s:1:\"1\";}i:24;a:10:{s:13:\"navigation_id\";s:2:\"26\";s:15:\"navigation_name\";s:24:\"NavbarLeft:@Manage users\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"49\";s:16:\"navigation_right\";s:2:\"54\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:30:31\";s:5:\"depth\";s:1:\"0\";}i:25;a:10:{s:13:\"navigation_id\";s:2:\"27\";s:15:\"navigation_name\";s:21:\"NavbarLeft:@All users\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"50\";s:16:\"navigation_right\";s:2:\"51\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:10:\"admin/user\";s:20:\"navigation_privilege\";s:17:\"admin@user@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:29:08\";s:5:\"depth\";s:1:\"1\";}i:26;a:10:{s:13:\"navigation_id\";s:2:\"28\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"52\";s:16:\"navigation_right\";s:2:\"53\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:14:\"admin/user/add\";s:20:\"navigation_privilege\";s:14:\"admin@user@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:29:09\";s:5:\"depth\";s:1:\"1\";}i:27;a:10:{s:13:\"navigation_id\";s:2:\"31\";s:15:\"navigation_name\";s:24:\"NavbarLeft:@Manage roles\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"55\";s:16:\"navigation_right\";s:2:\"60\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:32:19\";s:5:\"depth\";s:1:\"0\";}i:28;a:10:{s:13:\"navigation_id\";s:2:\"32\";s:15:\"navigation_name\";s:21:\"NavbarLeft:@All roles\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"56\";s:16:\"navigation_right\";s:2:\"57\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:10:\"admin/role\";s:20:\"navigation_privilege\";s:17:\"admin@role@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:32:19\";s:5:\"depth\";s:1:\"1\";}i:29;a:10:{s:13:\"navigation_id\";s:2:\"33\";s:15:\"navigation_name\";s:19:\"NavbarLeft:@Add new\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"58\";s:16:\"navigation_right\";s:2:\"59\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:14:\"admin/role/add\";s:20:\"navigation_privilege\";s:14:\"admin@role@add\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:32:19\";s:5:\"depth\";s:1:\"1\";}i:30;a:10:{s:13:\"navigation_id\";s:2:\"34\";s:15:\"navigation_name\";s:17:\"NavbarLeft:@Tools\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"61\";s:16:\"navigation_right\";s:2:\"66\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:0:\"\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:33:50\";s:5:\"depth\";s:1:\"0\";}i:31;a:10:{s:13:\"navigation_id\";s:2:\"35\";s:15:\"navigation_name\";s:27:\"NavbarLeft:@Import teachers\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"62\";s:16:\"navigation_right\";s:2:\"63\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:20:\"admin/import/teacher\";s:20:\"navigation_privilege\";s:25:\"admin@tool@import_teacher\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:33:50\";s:5:\"depth\";s:1:\"1\";}i:32;a:10:{s:13:\"navigation_id\";s:2:\"36\";s:15:\"navigation_name\";s:27:\"NavbarLeft:@Import students\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"64\";s:16:\"navigation_right\";s:2:\"65\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:20:\"admin/import/student\";s:20:\"navigation_privilege\";s:25:\"admin@tool@import_student\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:33:51\";s:5:\"depth\";s:1:\"1\";}i:33;a:10:{s:13:\"navigation_id\";s:2:\"37\";s:15:\"navigation_name\";s:20:\"NavbarLeft:@Settings\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"67\";s:16:\"navigation_right\";s:2:\"72\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:1:\"#\";s:20:\"navigation_privilege\";s:20:\"admin@setting@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:34:11\";s:5:\"depth\";s:1:\"0\";}i:34;a:10:{s:13:\"navigation_id\";s:2:\"39\";s:15:\"navigation_name\";s:28:\"NavbarLeft:@General settings\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"68\";s:16:\"navigation_right\";s:2:\"69\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:21:\"admin/setting/general\";s:20:\"navigation_privilege\";s:21:\"admin@setting@general\";s:23:\"navigation_date_created\";s:19:\"0000-00-00 00:00:00\";s:5:\"depth\";s:1:\"1\";}i:35;a:10:{s:13:\"navigation_id\";s:2:\"41\";s:15:\"navigation_name\";s:26:\"NavbarLeft:@Media settings\";s:16:\"navigation_level\";s:1:\"1\";s:15:\"navigation_left\";s:2:\"70\";s:16:\"navigation_right\";s:2:\"71\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:19:\"admin/setting/media\";s:20:\"navigation_privilege\";s:19:\"admin@setting@media\";s:23:\"navigation_date_created\";s:19:\"0000-00-00 00:00:00\";s:5:\"depth\";s:1:\"1\";}i:36;a:10:{s:13:\"navigation_id\";s:2:\"38\";s:15:\"navigation_name\";s:30:\"NavbarLeft:@Manage media files\";s:16:\"navigation_level\";s:1:\"0\";s:15:\"navigation_left\";s:2:\"73\";s:16:\"navigation_right\";s:2:\"74\";s:17:\"navigation_module\";s:5:\"admin\";s:14:\"navigation_url\";s:11:\"admin/media\";s:20:\"navigation_privilege\";s:18:\"admin@media@manage\";s:23:\"navigation_date_created\";s:19:\"2014-10-15 14:34:11\";s:5:\"depth\";s:1:\"0\";}}}s:5:\"token\";s:32:\"979664b451a046dab279dde8d98d0d93\";s:23:\"session.cookie_lifetime\";i:2592000;}}Admin_DataGrid_Score|a:4:{s:17:\"currentPageNumber\";i:1;s:7:\"orderBy\";s:7:\"exam_id\";s:6:\"sortBy\";s:3:\"ASC\";s:7:\"filters\";N;}Admin_DataGrid_Exam_Transcript_Printing|a:4:{s:17:\"currentPageNumber\";i:1;s:7:\"orderBy\";s:7:\"exam_id\";s:6:\"sortBy\";s:3:\"ASC\";s:7:\"filters\";N;}Admin_DataGrid_Score_Printing|a:4:{s:17:\"currentPageNumber\";i:1;s:7:\"orderBy\";s:7:\"exam_id\";s:6:\"sortBy\";s:3:\"ASC\";s:7:\"filters\";N;}Admin_DataGrid_Exam|a:4:{s:17:\"currentPageNumber\";i:1;s:7:\"orderBy\";s:7:\"exam_id\";s:6:\"sortBy\";s:3:\"ASC\";s:7:\"filters\";N;}Admin_DataGrid_Exam_Printing|a:4:{s:17:\"currentPageNumber\";i:1;s:7:\"orderBy\";s:7:\"exam_id\";s:6:\"sortBy\";s:3:\"ASC\";s:7:\"filters\";N;}Admin_DataGrid_Printing_Score|a:4:{s:17:\"currentPageNumber\";i:1;s:7:\"orderBy\";s:7:\"exam_id\";s:6:\"sortBy\";s:3:\"ASC\";s:7:\"filters\";N;}Admin_DataGrid_Printing_Exam_Participant|a:4:{s:17:\"currentPageNumber\";i:1;s:7:\"orderBy\";s:7:\"exam_id\";s:6:\"sortBy\";s:3:\"ASC\";s:7:\"filters\";N;}Lumia_Controller_Plugin_Security_Csrf|a:1:{s:3:\"key\";s:40:\"b6e971fd5b48d89d400da3ceba6aa0cb82cc5acf\";}__ZF|a:1:{s:37:\"Lumia_Controller_Plugin_Security_Csrf\";a:1:{s:3:\"ENT\";i:1453155160;}}');

-- ----------------------------
-- Table structure for core_student
-- ----------------------------
DROP TABLE IF EXISTS `core_student`;
CREATE TABLE `core_student` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_class` int(10) DEFAULT NULL,
  `student_department` int(11) DEFAULT '0',
  `student_address` int(11) DEFAULT '0' COMMENT 'Permanent Address',
  `student_birth` date DEFAULT NULL,
  `student_gender` enum('male','female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_user` int(11) NOT NULL DEFAULT '0',
  `student_identification` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `student_user_index` (`student_user`) USING BTREE,
  UNIQUE KEY `student_code_index` (`student_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=779 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_student
-- ----------------------------
INSERT INTO `core_student` VALUES ('1', 'Nguyễn Văn Nam', 'HS001', '1', '1', '5', '1983-06-03', 'male', '1', '', null);
INSERT INTO `core_student` VALUES ('2', 'Nguyen Truong Xuan', 'ertret54', '1', '1', '10', '1099-05-25', 'male', '5', '1425786', '2015-03-05 02:14:52');
INSERT INTO `core_student` VALUES ('3', 'Do Truong Giang', 'sdf34564', '2', '1', '11', '1988-08-20', 'male', '6', '', '2015-03-05 02:30:35');
INSERT INTO `core_student` VALUES ('4', 'Quang Anh', 'SV15', '3', '5', '13', '2012-05-26', 'male', '8', '', '2015-03-18 19:07:48');
INSERT INTO `core_student` VALUES ('5', 'Vu Minh', 'SV16', '3', '5', '14', '1989-03-22', 'male', '9', '', '2015-03-18 19:09:02');
INSERT INTO `core_student` VALUES ('6', 'QA01', 'QA01', '4', '7', '30', '1991-01-01', 'female', '26', '', '2015-03-25 16:28:15');
INSERT INTO `core_student` VALUES ('7', 'QA02', 'QA02', '4', '7', '31', '1991-01-01', 'female', '27', '', '2015-03-25 16:29:15');
INSERT INTO `core_student` VALUES ('8', 'QA03', 'QA03', '4', '7', '32', '1991-01-01', 'male', '28', '', '2015-03-25 16:30:16');
INSERT INTO `core_student` VALUES ('9', 'QA04', 'QA04', '4', '7', '33', '1991-01-01', 'male', '29', '', '2015-03-25 16:31:28');
INSERT INTO `core_student` VALUES ('10', 'Sinh vien Demo', 'Sinhvien-Demo', '5', '10', '37', '1998-12-11', 'female', '33', '', '2015-03-30 17:50:42');
INSERT INTO `core_student` VALUES ('11', 'Thúy', 'Thuy', '6', '11', '39', '1998-12-11', 'female', '35', '', '2015-03-30 18:09:14');
INSERT INTO `core_student` VALUES ('12', 'kl', 'kk', '7', '8', '43', '1993-01-01', 'female', '39', '', '2015-05-06 09:23:51');
INSERT INTO `core_student` VALUES ('13', 'Tít Mít', 'SV11', '8', '9', '45', '2012-12-22', 'male', '41', '', '2015-05-06 10:49:39');
INSERT INTO `core_student` VALUES ('778', 'Ho', 'QA007', '0', '0', '0', '1992-06-26', 'male', '0', null, '2015-05-13 14:10:39');

-- ----------------------------
-- Table structure for core_subject
-- ----------------------------
DROP TABLE IF EXISTS `core_subject`;
CREATE TABLE `core_subject` (
  `subject_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_status` tinyint(1) NOT NULL DEFAULT '0',
  `subject_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `subject_code_department_index` (`subject_code`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_subject
-- ----------------------------
INSERT INTO `core_subject` VALUES ('7', 'Toán học', 'Math', '1', '2014-09-26 02:31:50');
INSERT INTO `core_subject` VALUES ('8', 'Toan 1', 'T1', '1', '2015-03-18 19:16:43');
INSERT INTO `core_subject` VALUES ('9', 'Tin học', 'TH', '1', '2015-03-25 14:39:03');
INSERT INTO `core_subject` VALUES ('10', 'Địa lý', 'ĐL', '1', '2015-03-25 14:39:13');
INSERT INTO `core_subject` VALUES ('11', 'Thể dục', 'TD', '1', '2015-03-25 14:39:28');
INSERT INTO `core_subject` VALUES ('12', 'Mỹ Thuật', 'MT', '1', '2015-03-25 14:39:42');
INSERT INTO `core_subject` VALUES ('13', 'Âm nhạc', 'AN', '1', '2015-03-25 14:39:54');
INSERT INTO `core_subject` VALUES ('14', 'Vật lý', 'VL', '1', '2015-03-25 14:40:23');
INSERT INTO `core_subject` VALUES ('15', 'Lịch sử', 'LS', '1', '2015-03-25 14:40:35');
INSERT INTO `core_subject` VALUES ('16', 'Sinh học', 'SH', '1', '2015-03-25 14:41:01');
INSERT INTO `core_subject` VALUES ('17', 'Hóa học', 'HH', '1', '2015-03-25 14:41:16');
INSERT INTO `core_subject` VALUES ('18', 'Giáo dục Công dân', 'GDCD', '1', '2015-03-25 14:41:39');
INSERT INTO `core_subject` VALUES ('19', 'Ngữ Văn', 'NV', '1', '2015-03-25 14:41:57');
INSERT INTO `core_subject` VALUES ('20', 'Ngoại ngữ', 'NN', '1', '2015-03-25 14:42:50');
INSERT INTO `core_subject` VALUES ('21', 'Công nghệ', 'CN', '1', '2015-03-25 14:43:34');
INSERT INTO `core_subject` VALUES ('22', 'Ai là triệu phú', 'ALTP', '1', '2015-03-30 16:13:28');
INSERT INTO `core_subject` VALUES ('24', 'Vẽ', 've', '1', '2015-05-06 10:44:30');

-- ----------------------------
-- Table structure for core_teacher
-- ----------------------------
DROP TABLE IF EXISTS `core_teacher`;
CREATE TABLE `core_teacher` (
  `teacher_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_department` int(11) NOT NULL DEFAULT '0',
  `teacher_address` int(11) NOT NULL DEFAULT '0',
  `teacher_identification` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_birth` date DEFAULT NULL,
  `teacher_gender` enum('male','female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_user` int(11) DEFAULT '0',
  `teacher_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`teacher_id`),
  UNIQUE KEY `teacher_code_index` (`teacher_code`) USING BTREE,
  UNIQUE KEY `teacher_user_index` (`teacher_user`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_teacher
-- ----------------------------
INSERT INTO `core_teacher` VALUES ('2', 'Đỗ Trường Giang', 'MGV001', '1', '9', '', '1988-07-27', 'male', '3', null);
INSERT INTO `core_teacher` VALUES ('3', 'Nguyễn Lê Huyền', 'GV15', '5', '12', '', '1988-07-15', 'female', '7', '2015-03-18 19:05:10');
INSERT INTO `core_teacher` VALUES ('4', 'Luong Thi Thuy', 'GV16', '5', '15', '', '1991-06-27', 'female', '11', '2015-03-24 19:19:15');
INSERT INTO `core_teacher` VALUES ('5', 'Tinhoc', 'Tinhoc', '7', '16', '', '1991-01-01', 'female', '12', '2015-03-25 14:55:53');
INSERT INTO `core_teacher` VALUES ('6', 'Dialy', 'Dialy', '7', '17', '', '1991-01-01', 'female', '13', '2015-03-25 15:08:59');
INSERT INTO `core_teacher` VALUES ('7', 'Theduc', 'Theduc', '7', '18', '', '1991-01-01', 'female', '14', '2015-03-25 15:10:20');
INSERT INTO `core_teacher` VALUES ('8', 'Mythuat', 'Mythuat', '7', '19', '', '1991-01-01', 'male', '15', '2015-03-25 15:14:00');
INSERT INTO `core_teacher` VALUES ('9', 'Amnhac', 'Amnhac', '7', '20', '', '1991-01-01', 'male', '16', '2015-03-25 15:15:03');
INSERT INTO `core_teacher` VALUES ('10', 'Vatly', 'Vatly', '7', '21', '', '1991-01-01', 'male', '17', '2015-03-25 15:16:51');
INSERT INTO `core_teacher` VALUES ('11', 'Lichsu', 'Lichsu', '7', '22', '', '1991-01-01', 'male', '18', '2015-03-25 15:18:13');
INSERT INTO `core_teacher` VALUES ('12', 'Sinhhoc', 'Sinhhoc', '7', '23', '', '1991-01-01', 'male', '19', '2015-03-25 15:19:33');
INSERT INTO `core_teacher` VALUES ('13', 'Hoahoc', 'Hoahoc', '7', '24', '', '1991-01-01', 'female', '20', '2015-03-25 15:20:30');
INSERT INTO `core_teacher` VALUES ('14', 'GDCD', 'GDCD', '7', '25', '', '1991-01-01', 'female', '21', '2015-03-25 15:21:56');
INSERT INTO `core_teacher` VALUES ('15', 'Nguvan', 'Nguvan', '7', '26', '', '1991-01-01', 'female', '22', '2015-03-25 15:26:37');
INSERT INTO `core_teacher` VALUES ('16', 'Ngoaingu', 'Ngoaingu', '7', '27', '', '1991-01-01', 'male', '23', '2015-03-25 15:27:36');
INSERT INTO `core_teacher` VALUES ('17', 'Toanhoc', 'Toanhoc', '7', '28', '', '1991-01-01', 'male', '24', '2015-03-25 15:28:35');
INSERT INTO `core_teacher` VALUES ('18', 'Congnghe', 'Congnghe', '7', '29', '', '1991-01-01', 'male', '25', '2015-03-25 15:32:07');
INSERT INTO `core_teacher` VALUES ('19', 'Monchung', 'Monchung', '7', '34', '', '1991-01-01', 'male', '30', '2015-03-30 16:15:54');
INSERT INTO `core_teacher` VALUES ('20', 'Nguyễn Lê Huyền', 'GVV', '8', '35', '', '1988-07-15', 'female', '31', '2015-03-30 17:16:55');
INSERT INTO `core_teacher` VALUES ('22', 'Huyền', 'Huyen', '11', '38', '', '1988-07-15', 'female', '34', '2015-03-30 18:07:42');
INSERT INTO `core_teacher` VALUES ('23', 'Giáo viên demo', 'GV01', '7', '40', '', '1988-07-15', 'male', '36', '2015-03-30 18:32:37');
INSERT INTO `core_teacher` VALUES ('24', 'Giáo viên Demo 2', 'GV02', '7', '41', '', '1989-07-15', 'female', '37', '2015-03-30 18:50:30');
INSERT INTO `core_teacher` VALUES ('25', 'kl', 'kl', '8', '42', '', '1979-01-01', 'male', '38', '2015-05-06 09:20:50');
INSERT INTO `core_teacher` VALUES ('26', 'Hà Thu Trang', 'GV11', '9', '44', '', '1988-11-11', 'female', '40', '2015-05-06 10:46:33');
INSERT INTO `core_teacher` VALUES ('187', 'Nguyên Đức A5', 'A128', '0', '0', null, '1976-04-30', 'male', '0', '2015-05-13 10:41:03');

-- ----------------------------
-- Table structure for core_teacher_subject
-- ----------------------------
DROP TABLE IF EXISTS `core_teacher_subject`;
CREATE TABLE `core_teacher_subject` (
  `teacher_subject_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_subject_teacher` int(11) unsigned DEFAULT '0',
  `teacher_subject_subject` int(11) DEFAULT '0',
  PRIMARY KEY (`teacher_subject_id`),
  UNIQUE KEY `department_subject_index` (`teacher_subject_teacher`,`teacher_subject_subject`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of core_teacher_subject
-- ----------------------------
INSERT INTO `core_teacher_subject` VALUES ('7', '3', '7');
INSERT INTO `core_teacher_subject` VALUES ('8', '3', '8');
INSERT INTO `core_teacher_subject` VALUES ('9', '4', '7');
INSERT INTO `core_teacher_subject` VALUES ('24', '5', '9');
INSERT INTO `core_teacher_subject` VALUES ('25', '6', '10');
INSERT INTO `core_teacher_subject` VALUES ('47', '7', '11');
INSERT INTO `core_teacher_subject` VALUES ('48', '7', '24');
INSERT INTO `core_teacher_subject` VALUES ('27', '8', '12');
INSERT INTO `core_teacher_subject` VALUES ('28', '9', '13');
INSERT INTO `core_teacher_subject` VALUES ('29', '10', '14');
INSERT INTO `core_teacher_subject` VALUES ('16', '11', '15');
INSERT INTO `core_teacher_subject` VALUES ('17', '12', '16');
INSERT INTO `core_teacher_subject` VALUES ('18', '13', '17');
INSERT INTO `core_teacher_subject` VALUES ('19', '14', '18');
INSERT INTO `core_teacher_subject` VALUES ('20', '15', '19');
INSERT INTO `core_teacher_subject` VALUES ('21', '16', '20');
INSERT INTO `core_teacher_subject` VALUES ('22', '17', '7');
INSERT INTO `core_teacher_subject` VALUES ('23', '18', '21');
INSERT INTO `core_teacher_subject` VALUES ('34', '19', '22');
INSERT INTO `core_teacher_subject` VALUES ('39', '23', '10');
INSERT INTO `core_teacher_subject` VALUES ('40', '23', '22');
INSERT INTO `core_teacher_subject` VALUES ('43', '24', '14');
INSERT INTO `core_teacher_subject` VALUES ('44', '24', '22');
INSERT INTO `core_teacher_subject` VALUES ('46', '26', '24');

-- ----------------------------
-- Table structure for core_user
-- ----------------------------
DROP TABLE IF EXISTS `core_user`;
CREATE TABLE `core_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_salt` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'guest',
  `user_email` varchar(255) NOT NULL,
  `user_status` tinyint(1) DEFAULT '0',
  `user_date_created` datetime DEFAULT NULL,
  `user_date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_index` (`user_email`) USING BTREE,
  UNIQUE KEY `user_name_index` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1068 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_user
-- ----------------------------
INSERT INTO `core_user` VALUES ('2', 'admin_demo', null, '5ccfd74179f21a612101940c1df42519', 'snv3yQ1WwNWBzfQbfMJBixO5kYvZgVL9', 'administrator', 'admin@gmail.com', '1', '2014-09-16 11:22:55', '2014-11-15 07:22:38');
INSERT INTO `core_user` VALUES ('7', 'GV15', null, '42b576327ce970eb17253072081bcc7e', '7Czb3MVA4wne1BJoYq90wHyyN4A0zMH1', 'teacher', 'huyennl@qatmc.com', '1', '2015-03-18 19:05:10', null);
INSERT INTO `core_user` VALUES ('8', 'SV15', null, '619d7ac102ab64585de2258c2924e4b6', 'yxv9WFeaoe0IHZw1LqHPrZdqKvHQ8E6v', 'student', 'huyennguyen157@gmail.com', '1', '2015-03-18 19:07:48', null);
INSERT INTO `core_user` VALUES ('9', 'SV16', null, 'a1699c318eb71091f7e0f4b60d2d6604', 'uKYkDukwHK9nzf3jShci4HyrqVJQSmEg', 'student', 'minhvv@qatmc.com', '1', '2015-03-18 19:09:02', null);
INSERT INTO `core_user` VALUES ('10', 'admin_quanghuy', null, 'd601ca39a211ffc1acc6a30e0378ba24', 'HNEIYA0GyXeiKCVUFbeOGsynjxkZYopE', 'administrator', 'huynq@qatmc.com', '1', '2015-03-19 08:52:12', null);
INSERT INTO `core_user` VALUES ('11', 'GV16', null, 'c2818ab7ab44505d5fbecb7a3832e23c', 'ltv71hVj0sbYcIgSliNp1KKkBnEPAFnv', 'teacher', 'thuylt@qatmc.com', '1', '2015-03-24 19:19:15', '2015-03-24 12:22:20');
INSERT INTO `core_user` VALUES ('12', 'Tinhoc', null, 'e48b19aa9f68d2a50c8dc9a2707ac712', 'K7hrkmwVBnqth8HatVCHyAIB26dtcIy8', 'teacher', 'Tinhoc@gmail.com', '1', '2015-03-25 14:55:53', '2015-03-26 01:56:54');
INSERT INTO `core_user` VALUES ('13', 'Dialy', null, '02be960bffd6965470e095577b1ce973', '9L8ioO9nMuUGeFnqd2tf8h2vxtUrWoGG', 'teacher', 'Dialy@gmail.com', '1', '2015-03-25 15:08:59', '2015-03-26 01:57:49');
INSERT INTO `core_user` VALUES ('14', 'Theduc', null, '470b005487dbfa28748edb997ca96c8e', '2hrZifDAJ5PgpAgyKYYHF0vplpW8LhYD', 'teacher', 'Theduc@gmail.com', '1', '2015-03-25 15:10:20', '2015-03-26 02:15:14');
INSERT INTO `core_user` VALUES ('15', 'Mythuat', null, 'ef16359bff40aef1ed7aaa74ae988e28', 'U8x4YjCuzl7U5pRRvXEgxAcA9Q1OYuJy', 'teacher', 'Mythuat@gmail.com', '1', '2015-03-25 15:14:00', '2015-03-26 02:15:54');
INSERT INTO `core_user` VALUES ('16', 'Amnhac', null, 'f5bf978261370c76535a92cb85c2dc53', 'ZtFEu96pbq0ryAUowmbWsq7nFD29HT62', 'teacher', 'Amnhac@gmail.com', '1', '2015-03-25 15:15:03', '2015-03-26 02:16:46');
INSERT INTO `core_user` VALUES ('17', 'Vatly', null, '0662d98ea31fddb09ef58a53b47c1960', 'EHqZsmAWUDKUShkBeYiqxEHWJPnG0t95', 'teacher', 'Vatly@gmail.com', '1', '2015-03-25 15:16:51', '2015-03-26 02:17:16');
INSERT INTO `core_user` VALUES ('18', 'Lichsu', null, '25b1609011e621927ac4c8304d6e4934', 'hi0nhmVgNw88LiIigpdXNW0034vFzPqB', 'teacher', 'Lichsu@gmail.com', '1', '2015-03-25 15:18:13', null);
INSERT INTO `core_user` VALUES ('19', 'Sinhhoc', null, '58ed9ea1a8834609505f469853558bd4', 'Y9Oo2NP38nYyJWU0miHq6btvYLXQPVu7', 'teacher', 'Sinhhoc@gmail.com', '1', '2015-03-25 15:19:33', null);
INSERT INTO `core_user` VALUES ('20', 'Hoahoc', null, '8cea8f0a9470d2ed211ad9cbe4c22ffa', 'NebP2Yfo8UQDWZdsNtRpAAmhYBFODArs', 'teacher', 'Hoahoc@gmail.com', '1', '2015-03-25 15:20:30', null);
INSERT INTO `core_user` VALUES ('21', 'GDCD', null, 'cb3d26ae07473301d72ca5e60c9f4cc6', 'lXcy2NY4UJeCumC3qyxrL2vbjiO0b7Ei', 'teacher', 'Gdcd@gmail.com', '1', '2015-03-25 15:21:56', '2015-03-26 07:20:17');
INSERT INTO `core_user` VALUES ('22', 'Nguvan', null, '35f8279678603fa768cb396c18777478', 'O2dNlgPUykfeCDY83YmZwe0YnJ4JXEBA', 'teacher', 'Nguvan@gmail.com', '1', '2015-03-25 15:26:37', null);
INSERT INTO `core_user` VALUES ('23', 'Ngoaingu', null, '5999ad751265b804d4c4751c2acc3fce', 'hhGfEhlMh5vzo1orB7vNmV93ywyPOve6', 'teacher', 'Ngoaingu@gmail.com', '1', '2015-03-25 15:27:36', null);
INSERT INTO `core_user` VALUES ('24', 'Toanhoc', null, 'c021aa35417efc94b1c9d068a269ddcb', 'FKRCOG6SAEBZ2RZjHXrfLcOjhrStFcgV', 'teacher', 'Toanhoc@gmail.com', '1', '2015-03-25 15:28:35', null);
INSERT INTO `core_user` VALUES ('25', 'Congnghe', null, 'a474804927ee13e599fb37a25a8c063d', 'JDIre1NBKOcBLcuSTLAW9PTqmNV7NSu2', 'teacher', 'Congnghe@gmail.com', '1', '2015-03-25 15:32:07', null);
INSERT INTO `core_user` VALUES ('26', 'QA01', null, '203a6fc82c00d7dcedde01ad9a8891d3', 'hHD0QmrfleUdyHSikSRZjucA42YIUvf3', 'student', 'QA01@gmail.com', '1', '2015-03-25 16:28:15', null);
INSERT INTO `core_user` VALUES ('27', 'QA02', null, '3ab15c0975ff75530645696b0b504f78', 'cA4Lc9r0OiRQmkwZGmeCoLOkh5QSLN99', 'student', 'QA02@gmail.com', '1', '2015-03-25 16:29:15', null);
INSERT INTO `core_user` VALUES ('28', 'QA03', null, '2f9098f79626d9e4c286986206f97002', 'SiyKU6BVaHn2zVhMhHIS4AazgluM0bbB', 'student', 'QA03@gmail.com', '1', '2015-03-25 16:30:16', null);
INSERT INTO `core_user` VALUES ('29', 'QA04', null, '244e9ad36fae8c37cbd7c0846344c57f', 'AQTcfpvnM4QMqs6WtjQQ6gAtaocQUIqX', 'student', 'QA04@gmail.com', '1', '2015-03-25 16:31:28', null);
INSERT INTO `core_user` VALUES ('30', 'Monchung', null, '53819a9afde11a5e0ae5c2a448d03cab', '3FkdAmLGPcrmuRImQRXvDl3ZaSzaC46H', 'teacher', 'monchung@gmail.com', '1', '2015-03-30 16:15:54', null);
INSERT INTO `core_user` VALUES ('31', 'GVV', null, '218db3ebf88e84b917c70bca415b1db1', 'fkBgIheKswXzRhvOlTaWNPD0wcZ2Cqu7', 'teacher', 'tambietdolly157@gmail.com', '1', '2015-03-30 17:16:55', null);
INSERT INTO `core_user` VALUES ('32', 'GV-demo', null, '6f55ada88dddc9d3844a24bcd866cbba', 'r292dKnqDE8wXus1Q6mNBTDeOUACWFiR', 'teacher', 'huyenkokkola@qatmc.com', '1', '2015-03-30 17:39:02', null);
INSERT INTO `core_user` VALUES ('33', 'Sinhvien-Demo', null, '8cf1bd0b836c6ac7768c679affa31bb8', '4hnty4diGiwjVaOKdoTfKYAvEOYHPJJA', 'student', 'huyennl@gmail.com', '1', '2015-03-30 17:50:43', null);
INSERT INTO `core_user` VALUES ('34', 'Huyen', null, 'e5a040a9745221dfdf539bad9924d089', 'Uo5jkycZvgR7OHydCJ8dcJPcrjjBLe7W', 'teacher', 'huyenl@hotmail.com', '1', '2015-03-30 18:07:42', null);
INSERT INTO `core_user` VALUES ('35', 'Thuy', null, '36abd0e487a19c4a48f4fedc1b8dd967', '67H7mDWyOC6Ie8D5qKglNiYu3PCXpZE6', 'student', 'thuynl@hotmmail.com', '1', '2015-03-30 18:09:14', null);
INSERT INTO `core_user` VALUES ('36', 'GV01', null, '66ba1fcb08f261fa1d93a4e2f73f9800', 'Abk9LcruwAIhTd3AD5ga3cyzNZUoOG8o', 'teacher', 'huyen@hotmail.com', '1', '2015-03-30 18:32:37', null);
INSERT INTO `core_user` VALUES ('37', 'GV02', null, '271140f829b230f262aab43aa2499d64', 'QWsp8hcjZLcabKh8F8CdS45xA4FTuoBS', 'teacher', 'huyennguyen@gmail.com', '1', '2015-03-30 18:50:30', null);
INSERT INTO `core_user` VALUES ('40', 'GV11', null, 'de3f36fdcc949af5716e80bb9c3f2381', 'kAf1LSLbfnE82c45FZH1AJIcSIPDO9VU', 'teacher', 'gv11@gmail.com', '1', '2015-05-06 10:46:33', null);
INSERT INTO `core_user` VALUES ('41', 'SV11', null, '7f54864cc301b7ca652e9e5088157d6d', 'ri66X9HNSSzBLvlsDextRKHQ26dq4Spf', 'student', 'sv11@gmail.com', '1', '2015-05-06 10:49:39', null);
INSERT INTO `core_user` VALUES ('43', 'hk', null, '43da8001fdeb6ca90aa145d2aa9e2ed9', 'uulLeGidRahEcuqkoYcKEK3OJxojGYMR', 'teacher', 'hk@gmail.com', '1', '2015-05-06 13:39:57', null);
INSERT INTO `core_user` VALUES ('750', 'A123', null, '622294213a991133dc985ea034f9c851', 'd77xoipxh9hh5vqa3xn3', 'teacher', 'a123@gmail.com', '1', '2015-05-13 10:41:03', null);
INSERT INTO `core_user` VALUES ('751', 'A124', null, '449846821e4c431fd0b262c0183f1b14', 'toz8t1r8i8tzxz5i563q', 'teacher', 'A124@gmail.com', '1', '2015-05-13 10:41:03', null);
INSERT INTO `core_user` VALUES ('752', 'A125', null, '60cab6c11a92a5085b4a75afd6527c4f', 'y7fdwiya53pceh0t7oif', 'teacher', 'A125@gmail.com', '1', '2015-05-13 10:41:03', null);
INSERT INTO `core_user` VALUES ('753', 'A126', null, 'e84776d23b7779e5cb0cb077f3fb14cd', 'ggu9p9x5wfnps77ogzgc', 'teacher', 'A126@gmail.com', '1', '2015-05-13 10:41:03', null);
INSERT INTO `core_user` VALUES ('754', 'A127', null, '54256fb652c1ac23944ddc5dc16f0dae', '3ex3ky02dq9t1k0y0vo8', 'teacher', 'A127@gmail.com', '1', '2015-05-13 10:41:03', null);
INSERT INTO `core_user` VALUES ('755', 'A128', null, 'dde053a84b234b6b3edb3c0be6351cb0', 'imsevgs1fccnjxi370kp', 'teacher', 'A128@gmail.com', '1', '2015-05-13 10:41:03', null);
INSERT INTO `core_user` VALUES ('905', 'SA123', null, 'cad1b0caf3df789c7fc99e8b1c2066c9', '4nbwbxwzq25krfcah8qd', 'student', 'SA123X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('906', 'SA124', null, '2c864c1f6a9b43ba7bf9f944b37be74f', 'sdtl9983q0lhj447j2zu', 'student', 'SA124X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('907', 'SA125', null, '142ee2e6924ce1fd23a6803f431d73f2', 'esf1f12rtfma0ffd4cm0', 'student', 'SA125X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('908', 'SA126', null, '01b9ad18d6dc059bd3f4117c173253c7', 'xd80rnhgwd0w0y4votqr', 'student', 'SA126X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('909', 'SA127', null, 'abb6c0b5c6682e7216a677e99fc896a8', 'unmjxkur2yicxyz2q9h4', 'student', 'SA127X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('910', 'SA128', null, 'ec4320be2b3cd8755d346e4e13fbe917', '8apxps3lg8jrgyh7nbk9', 'student', 'SA128X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('911', 'SA129', null, '71ca6899f4458d60f614d89cf63bb799', 'b7e53v0hjibqowsp3d6e', 'student', 'SA129X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('912', 'SA130', null, 'd5cc1894aa89dc65dc0cebc05d340d97', 'kqz0olaugr46iu23xeee', 'student', 'SA130X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('913', 'SA131', null, '4a6b531eb8aa6a85f223bd7831f7b9ab', '5vt9d8d8tij3tc768wb6', 'student', 'SA131X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('914', 'SA132', null, '4b4171afb9a5966ce1423cba628a1694', 'jo8nhs43q696bav1ab1e', 'student', 'SA132X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('915', 'SA133', null, 'f988a34e331e3759f6e219bd860213bb', 'jxq9y74g4o3cv0wz3u1w', 'student', 'SA133X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('916', 'SA134', null, '73e8e7e3cfe84816c45a9cd367f4b7e5', '3r6rjay8zh59wuscg8te', 'student', 'SA134X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('917', 'SA135', null, '054f3bd66178f3718d60eb212e000d39', 'pfg37a1uxb6ljfnnpdav', 'student', 'SA135X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('918', 'SA136', null, '1e3c7aa9ddf1955246c5fa8a55b48b68', '20emwvkjpgoqbtrhkot8', 'student', 'SA136X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('919', 'SA137', null, '7e5e1cbd49c4eb3662c117d68a2fe31d', 'nvy5x9y09yce0stpfxwz', 'student', 'SA137X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('920', 'SA138', null, 'd6b3c6f0950235bbc7941f16cd3e3ecb', 'k7xyhsvgfqm0uw8j3urd', 'student', 'SA138X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('921', 'SA139', null, '1ce715d6487fc0566534dd9f7bdf07f7', 'goddpsl3msbbrg978zka', 'student', 'SA139X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('922', 'SA140', null, '4ca17174ad20ffc9962f201364c746ad', '67d0fnzzwzdva8kusyfn', 'student', 'SA140X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('923', 'SA141', null, '78c4e552ab21752cbcc8a0cd22a7017a', 'lmemz97zfitttysh92jt', 'student', 'SA141X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('924', 'SA142', null, '34abf4f30328c1a2a09ffef0f53928df', '9l682arer60v072p7031', 'student', 'SA142X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('925', 'SA143', null, '6d76f30e13cff44dd6ab701bd8c69e3f', 'nndstq8cbbqdsygafnyg', 'student', 'SA143X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('926', 'SA144', null, '70a743dc7ac1479ea66bfdfb4cc921ff', '1fhfnk3nyekf2l18loym', 'student', 'SA144X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('927', 'SA145', null, '6f1034f4bbb052a9bb1edfa83d7ef2ab', '69yi1xwev6wk7y8u5b5v', 'student', 'SA145X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('928', 'SA146', null, 'd0d1d030e3b27a7f4b9cf091c33d9b74', 'ryaufq8u4skm8o6mvdcl', 'student', 'SA146X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('929', 'SA147', null, '95a5c6e591a4fc764a5256aceb870db6', 'iagb55mrjylzq5g7ml8m', 'student', 'SA147X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('930', 'SA148', null, 'e77918fc73afbe92317bf797046e3c97', 'dno7vc7t10j0i0da3g6p', 'student', 'SA148X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('931', 'SA149', null, '19a23ea6fa9d36a32cd477aee7de5faf', 'tkt5mpwr4knytqrpgmmr', 'student', 'SA149X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('932', 'SA150', null, '76d3dbc97fb067e3e7d47de7c1461f84', 'lcqagy3crxp1mqk0pof5', 'student', 'SA150X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('933', 'SA151', null, '1ee6ddb397f4a91d1618f2112b927cc8', '7lvgbcy106js3nrtzaig', 'student', 'SA151X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('934', 'SA152', null, '251497dfb8ea206aa95927f7fb0aa522', 'k1vbjwpa9yy1m8y8yecl', 'student', 'SA152X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('935', 'SA153', null, '28f934258ab3640241d0888320f2b586', 'l9f7darehtznbfj721i8', 'student', 'SA153X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('936', 'SA154', null, '69bd46af36635aef67507af66de550b2', 'eh6by50efp83hslu3446', 'student', 'SA154X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('937', 'SA155', null, '86526efcf04f6d98a0b86a1a6609e14c', '8sw9k7q6sfyr4hax28qp', 'student', 'SA155X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('938', 'SA156', null, '62b649ebbed1eeb801623de7ce945140', 'haf2zuspam4qd0lbn1k0', 'student', 'SA156X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('939', 'SA157', null, '005c47a81eb011f33ece8afc0c84b349', 'v5jdzvotczxwlo8mo8j6', 'student', 'SA157X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('940', 'SA158', null, 'f88e2cc0d95a2878731ba9f89e1e6cff', 'j9fh133br4fxwa25tsic', 'student', 'SA158X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('941', 'SA159', null, 'fe78d76892273272fd9c3a6670d041a1', '92az7iwwbq2lirqftf08', 'student', 'SA159X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('942', 'SA160', null, 'daf61f3256130357828ac867559bf15d', 'rjipop4t3rtdum3e43o0', 'student', 'SA160X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('943', 'SA161', null, '6bd25b20764ec9257826d27babbff44f', '999pikvafnd4uk6vui8j', 'student', 'SA161X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('944', 'SA162', null, 'f76d12b1e60337f1d672b873f1733777', 'mrv8a6mbm4z4o1weqxoq', 'student', 'SA162X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('945', 'SA163', null, 'dbcc946a3b826c99d1d76842d18b698d', 'yke5pqwplpz2mh3chvx5', 'student', 'SA163X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('946', 'SA164', null, 'a027882d70a16be7e757dc2fbf6443be', '02kqnigju7o3nmsgorc1', 'student', 'SA164X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('947', 'SA165', null, '981480461c427f467d6e3db9280bd9e4', '34b0zwwsi9npzohsnu4l', 'student', 'SA165X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('948', 'SA166', null, '7cdbabd5ea04fbcd41bb420d72e629fd', 'cwtp8gtktyksoq60ktd2', 'student', 'SA166X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('949', 'SA167', null, 'd086d9edba49788372deb02b982d1348', 'i7mku6rd15o969yl2fba', 'student', 'SA167X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('950', 'SA168', null, '67c11cb0ea5a756299835f181062b5da', 'ke0pbsfhzpv3470jxczl', 'student', 'SA168X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('951', 'SA169', null, '6a033bdd2eccc5dddc0aa9bb424e845f', '7xc0e60avgot04kr9nfj', 'student', 'SA169X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('952', 'SA170', null, 'f48197e20ae047c4a253798dd8e0ccf8', 'juqs0yeof6mqraxalo87', 'student', 'SA170X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('953', 'SA171', null, '7b4892aa3b06a2632b5b3d36c24d2771', 'vbh11sh74x4znfbic772', 'student', 'SA171X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('954', 'SA172', null, '82bcf85754a4a7880b8c0034f82d0372', 'vvg7n8ltt1mtmdzfsnln', 'student', 'SA172X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('955', 'SA173', null, '83b6d84f8d81cb4ee76a3c0fc4c71809', '6ejnsxwo0dkwl9s36uet', 'student', 'SA173X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('956', 'SA174', null, '49fc6900b0693544862e60ce66d55dcf', 'w3fvlzixoajmoyy0r2hi', 'student', 'SA174X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('957', 'SA175', null, '44d4294453eeb19a7a87fc0d70a95ecc', 'ctnc0fj60ebon3llounq', 'student', 'SA175X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('958', 'SA176', null, '6fdd09ec5b829f274674f93d2ad1ca25', '19xkrcfbwyuklbw3x0ox', 'student', 'SA176X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('959', 'SA177', null, '526f51857671222ce48c3ebf4f8eed10', '9q4g6nodmxrli680bxnk', 'student', 'SA177X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('960', 'SA178', null, '2e9414e026390a4e1cb6022fc0af0bfd', 'f08olurzc7gh8bdiqf6p', 'student', 'SA178X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('961', 'SA179', null, '2b9b4e6d42939d2cf9e66b6ee4e7f40c', '6wbw7ydnzsjq94yvewvn', 'student', 'SA179X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('962', 'SA180', null, '4e0b8b973061726984030c6efe7227dd', '0rv1qb2knmkyyn41rumv', 'student', 'SA180X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('963', 'SA181', null, '633e1f219fcf46f7b0eb59933423cfe1', 'g9xy40a68q5llu1wi2jb', 'student', 'SA181X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('964', 'SA182', null, '7ef5ea07ecda9ed7e72ad0c398e2a6bd', 'pykz7te0qn4v6y1rfn9g', 'student', 'SA182X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('965', 'SA183', null, 'b99181d26edf2478ef931a82236f9ff2', 'pk5uplmzlfpgok13m2c1', 'student', 'SA183X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('966', 'SA184', null, 'aef4914f03ae118c0f09ed29b768049f', 'cvtvp74goh190dlc71z8', 'student', 'SA184X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('967', 'SA185', null, '26c0f8592eb4f5aecc447119fac641f1', 'syqbme2rpib3tbeefqqh', 'student', 'SA185X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('968', 'SA186', null, 'bd7bdbfea3fea478901ec8c5bee4986b', '5kemu46g9r9d6wj77xoi', 'student', 'SA186X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('969', 'SA187', null, 'eb5305a088debc3078fa32f87bf05413', 'pxh9hh5vqa3xn3yoz8t1', 'student', 'SA187X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('970', 'SA188', null, '8c6fa35afa5e690f8bc311a2b21b9d01', 'r8i8tzxz5i563qy7fdwi', 'student', 'SA188X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('971', 'SA189', null, '0256274fd64e802922c5f606aab527b4', 'ya53pceh0t7oifggu9p9', 'student', 'SA189X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('972', 'SA190', null, 'c259e995a9fb4e4d048b8869439bfd9e', 'x5wfnps77ogzgc3ex3ky', 'student', 'SA190X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('973', 'SA191', null, '5b011947684a507248340ed33cd4406e', '02dq9t1k0y0vo8imsevg', 'student', 'SA191X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('974', 'SA192', null, 'd22545f88126bafa51e42e81604f03b3', 's1fccnjxi370kpppl3j9', 'student', 'SA192X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('975', 'SA193', null, '067b7bfe88f26a5975fc3b4605693108', 'bje2mm9rshztsknr4vgo', 'student', 'SA193X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('976', 'SA194', null, 'e82ff1611952ecba2a7de161a49d9060', 'gjxg3a7npy2t1owakwfk', 'student', 'SA194X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('977', 'SA195', null, '9d295a217e90643ca58d51b30f2d11c1', 'pvatjps3qd3jem6ydnr1', 'student', 'SA195X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('978', 'SA196', null, 'e0157e211b98c6d348600983876c3661', 'o8ydqrmk3f903ht3k9q5', 'student', 'SA196X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('979', 'SA197', null, 'ce093e558b9f31c14a4ac7199a5da520', 's0h6tjtazzw5uf5nmgs3', 'student', 'SA197X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('980', 'SA198', null, 'c867308f21f045d556cde6e593b20842', '8ik693ihqiheafh2j5kc', 'student', 'SA198X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('981', 'SA199', null, '3b4e87e464b268b37060457ab1af02f6', '2ymxfnjnmk88nwewtqkt', 'student', 'SA199X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('982', 'SA200', null, '269e2308641b48a85b08cd52cf47e371', 'beb3i5hxvc3tx7hk4yuv', 'student', 'SA200X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('983', 'SA201', null, '5a1f2936247ba98cb66fd1797f7a6dad', 'gih7vd9jtwyr51c49za3', 'student', 'SA201X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('984', 'SA202', null, '482d7a62b77dc5ebd8c2122020e3d99a', '8lwo37wre5dgr7b9yzrj', 'student', 'SA202X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('985', 'SA203', null, 'eb84ec4bf48c04c9c14e5e106b2f9846', 'nhtvbe5fm8rvhtbg26fw', 'student', 'SA203X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('986', 'SA204', null, '3da6dd2ca23a245a808cc598aad1f926', '21d2fmvrdgwmj2gro5ix', 'student', 'SA204X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('987', 'SA205', null, '6994c0052d32c8112134f63179465a02', 'v0ex6vkayy5duc7xx3b8', 'student', 'SA205X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('988', 'SA206', null, 'c63853e81cfcc5e03f329b8dd47e0446', 'o31wuahabauk7hjzsjg1', 'student', 'SA206X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1014', 'SA232', null, '4201ff305f161c8eb7a41bf059e4f45e', 'dsygafnyg1fhfnk3nyek', 'student', 'SA232X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1015', 'SA233', null, 'd69eb10684294a8685d07cced01d550c', 'f2l18loym69yi1xwev6w', 'student', 'SA233X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1016', 'SA234', null, 'e447982f9054884dbdcb4e58c14b189e', 'k7y8u5b5vryaufq8u4sk', 'student', 'SA234X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1017', 'SA235', null, '52e6c19482e118d9ea13597238d08c91', 'm8o6mvdcliagb55mrjyl', 'student', 'SA235X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1018', 'SA236', null, '0c02b506e1b2b362f207e39b1c1dde31', 'zq5g7ml8mdno7vc7t10j', 'student', 'SA236X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1019', 'SA237', null, '81b0facd6933a6fe2dfd0bf5d34f3996', '0i0da3g6ptkt5mpwr4kn', 'student', 'SA237X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1020', 'SA238', null, '5e549975a0ef24e228171feb61fa4045', 'ytqrpgmmrlcqagy3crxp', 'student', 'SA238X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1021', 'SA239', null, 'b75c4b260d1f0704617f373bfd84f9d3', '1mqk0pof57lvgbcy106j', 'student', 'SA239X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1022', 'SA240', null, '9956765d94c72d66ee45805a7a8a1cf9', 's3nrtzaigk1vbjwpa9yy', 'student', 'SA240X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1023', 'SA241', null, '7b3d1e7efb0a9ee5446400a73aff0775', '1m8y8yecll9f7darehtz', 'student', 'SA241X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1024', 'SA242', null, 'ad7901d4183414b29785e76a9144ca01', 'nbfj721i8eh6by50efp8', 'student', 'SA242X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1025', 'SA243', null, 'e768c65c618aaa6c329eb509ed93f7b7', '3hslu34468sw9k7q6sfy', 'student', 'SA243X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1026', 'SA244', null, '1124437f8d8aa693232eb10e1e4ee9f0', 'r4hax28qphaf2zuspam4', 'student', 'SA244X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1027', 'SA245', null, '6380dc3d4287da28df72901447a4a5f5', 'qd0lbn1k0v5jdzvotczx', 'student', 'SA245X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1028', 'SA246', null, '3469d82924022428cadb60583e139e50', 'wlo8mo8j6j9fh133br4f', 'student', 'SA246X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1029', 'SA247', null, 'c9648974118d2e0292fb7a20c53b3d10', 'xwa25tsic92az7iwwbq2', 'student', 'SA247X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1030', 'SA248', null, 'd2d4373b23e07bcaa23401cc8c4c27c6', 'lirqftf08rjipop4t3rt', 'student', 'SA248X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1031', 'SA249', null, '3a9411cb05f848e5621ebfa3c5f1ba55', 'dum3e43o0999pikvafnd', 'student', 'SA249X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1032', 'SA250', null, '6f390253ee6aeebd425be5f60d1f0382', '4uk6vui8jmrv8a6mbm4z', 'student', 'SA250X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1033', 'SA251', null, 'f7d63f3e03af22762bd8d28dcb237d3e', '4o1weqxoqyke5pqwplpz', 'student', 'SA251X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1034', 'SA252', null, '1cb49caf80a0fcf3a47287e8fa59db84', '2mh3chvx502kqnigju7o', 'student', 'SA252X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1035', 'SA253', null, 'bb212901a62891052c1e75f235b59e4e', '3nmsgorc134b0zwwsi9n', 'student', 'SA253X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1036', 'SA254', null, '0c7498f9bae39271309c1c53e2a58f4f', 'pzohsnu4lcwtp8gtktyk', 'student', 'SA254X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1037', 'SA255', null, 'c58e0cf89a73f7c448aa8c7216482b3a', 'soq60ktd2i7mku6rd15o', 'student', 'SA255X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1038', 'SA256', null, '12321ea90907ab76a06e176d91f88be3', '969yl2fbake0pbsfhzpv', 'student', 'SA256X@gmail.com', '1', '2015-05-13 10:42:19', null);
INSERT INTO `core_user` VALUES ('1061', 'QA001', null, 'e2c24f97e096daadb1514001cadde1a2', '0lbn1k0v5jdzvotczxwl', 'student', 'QA001@gmail.com', '1', '2015-05-13 14:10:39', null);
INSERT INTO `core_user` VALUES ('1062', 'QA002', null, 'bca745e4788c224789e754e967fbde5b', 'o8mo8j6j9fh133br4fxw', 'student', 'QA002@gmail.com', '1', '2015-05-13 14:10:39', null);
INSERT INTO `core_user` VALUES ('1063', 'QA003', null, 'ad68ef22395c3e6ffafe0aa35f8e067f', 'a25tsic92az7iwwbq2li', 'student', 'QA003@gmail.com', '1', '2015-05-13 14:10:39', null);
INSERT INTO `core_user` VALUES ('1064', 'QA004', null, '51ad1c5e7463da2f394425b7cde8d7fe', 'rqftf08rjipop4t3rtdu', 'student', 'QA004@gmail.com', '1', '2015-05-13 14:10:39', null);
INSERT INTO `core_user` VALUES ('1065', 'QA005', null, '50e687463ebbddf5b8835b74cddffb4b', 'm3e43o0999pikvafnd4u', 'student', 'QA005@gmail.com', '1', '2015-05-13 14:10:39', null);
INSERT INTO `core_user` VALUES ('1066', 'QA006', null, 'a4567f7bc8f01cc3a445184346df31f4', 'k6vui8jmrv8a6mbm4z4o', 'student', 'QA006@gmail.com', '1', '2015-05-13 14:10:39', null);
INSERT INTO `core_user` VALUES ('1067', 'QA007', null, '24d298908b0c41ddff5581a7a0600b78', '1weqxoqyke5pqwplpz2m', 'student', 'QA007@gmail.com', '1', '2015-05-13 14:10:39', null);
