<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'ينبغي تمرير طريقة التحقق من صحة البريد الإلكتروني عبر مصفوفة.';
$lang['email_invalid_address'] = 'عنوان البريد الإلكتروني غير سليم: %s';
$lang['email_attachment_missing'] = 'لم نتمكن من تحديد موقع مرفقات البريد الإلكتروني التالية: %s';
$lang['email_attachment_unreadable'] = 'لم نتمكن من فتح هذا النوع من المرفقات: %s';
$lang['email_no_from'] = 'لا يمكن إرسال رسالة البريد الإلكتروني دون إدخال عنوان الرسالة.';
$lang['email_no_recipients'] = 'يجب إدخال اسم المرسل إليه، والنسخة المرسلة، والنسخة المخفية';
$lang['email_send_failure_phpmail'] = 'لم نتمكن من إرسال البريد الإلكتروني باستخدام بريد PHP: ربما لم تقم بضبط تكوين الملقم الخاص بك لإرسال البريد الإلكتروني بهذه الطريقة.';
$lang['email_send_failure_sendmail'] = 'لم نتمكن من إرسال البريد الإلكتروني باستخدام تناسخ PHP: ربما لم تقم بضبط تكوين الملقم الخاص بك لإرسال البريد الإلكتروني بهذه الطريقة.';
$lang['email_send_failure_smtp'] = 'لم نتمكن من إرسال البريد الإلكتروني باستخدام بروتوكول نقل البريد الإلكتروني PHP: ربما لم تقم بضبط تكوين الملقم الخاص بك لإرسال البريد الإلكتروني بهذه الطريقة.';
$lang['email_sent'] = 'تم إرسال الرسالة بنجاح باستخدام البروتوكول التالي: %s';
$lang['email_no_socket'] = 'لم نتمكن من فتح منفذ تناسخ Sendmail. رجاء التحقق من الإعدادات.';
$lang['email_no_hostname'] = 'لم تقم باختيار اسم مضيف بروتوكول نقل البريد الإلكتروني SMTP.';
$lang['email_smtp_error'] = 'حدث خطأ ما باسم المضيف بروتوكول نقل البريد الإلكتروني SMTP: %s';
$lang['email_no_smtp_unpw'] = 'خطأ: يجب تعيين اسم بروتوكول نقل البريد الإلكتروني SMTP وكلمة المرور.';
$lang['email_failed_smtp_login'] = 'لم نتمكن من إرسال أمر تسجيل الدخول الآمن AUTH LOGIN. خطأ: %s';
$lang['email_smtp_auth_un'] = 'فشل التحقق من اسم المستخدم. خطأ: %s';
$lang['email_smtp_auth_pw'] = 'فشل التحقق من كلمة المرور. خطأ: %s';
$lang['email_smtp_data_failure'] = 'فشل إرسال البيانات: %s';
$lang['email_exit_status'] = 'ترميز حالة تسجيل الخروج: %s';
