delete from users where user_type != 'admin';
delete from address where id != 1;
delete from module_address where id != 1;

truncate patient_records;
truncate attachments;
truncate classifications;
truncate classification_respondents;
truncate deployments;
truncate form_respondents;
truncate hospitals;
truncate laboratory_requests;
truncate laboratory_results;
truncate patient_records;
truncate record_form_respondents;
truncate system_notifications;
truncate system_notification_recipients;