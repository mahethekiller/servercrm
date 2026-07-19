# Database Schema Reference (Database: devcodi)

## Table: attribute_types

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int | NO | PRI | NULL | auto_increment |
| name | varchar(50) | NO |  | NULL |  |
| status | tinyint(1) | YES |  | 1 |  |
| added | datetime | YES |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| updated | datetime | YES |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |

## Table: attributes

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int | NO | PRI | NULL | auto_increment |
| attribute_name | varchar(255) | NO |  | NULL |  |
| attribute_type | int | NO |  | NULL |  |
| price | varchar(100) | YES |  | NULL |  |
| status | enum('active','inactive') | NO |  | active |  |
| added_date | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| updated_at | datetime | YES |  | NULL |  |

## Table: companies

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int | NO | PRI | NULL | auto_increment |
| name | varchar(255) | NO |  | NULL |  |
| client_name | varchar(255) | NO |  | NULL |  |
| country_code | varchar(10) | YES |  | NULL |  |
| gst_no | varchar(50) | YES |  | NULL |  |
| cin_no | varchar(100) | YES |  | NULL |  |
| city | varchar(100) | NO |  | NULL |  |
| state | varchar(100) | NO |  | NULL |  |
| industry | varchar(100) | NO |  | NULL |  |
| email | varchar(255) | NO |  | NULL |  |
| phone | varchar(20) | NO |  | NULL |  |
| address | text | NO |  | NULL |  |
| pin_code | varchar(10) | NO |  | NULL |  |
| country | varchar(100) | YES |  | NULL |  |
| pan_no | varchar(50) | YES |  | NULL |  |
| website | varchar(200) | YES |  | NULL |  |
| created_at | timestamp | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| updated_at | timestamp | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
| it_contact_email | varchar(255) | YES |  | NULL |  |
| it_contact_phone | varchar(50) | YES |  | NULL |  |
| it_contact_name | varchar(100) | YES |  | NULL |  |
| finance_contact_email | varchar(255) | YES |  | NULL |  |
| finance_contact_phone | varchar(50) | YES |  | NULL |  |
| finance_contact_name | varchar(100) | YES |  | NULL |  |
| lead_value | decimal(10,2) | YES |  | 0.00 |  |
| custom_contacts | text | YES |  | NULL |  |

## Table: company_documents

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int | NO | PRI | NULL | auto_increment |
| company_id | int | NO |  | NULL |  |
| contact_name | varchar(255) | YES |  | NULL |  |
| file_name | varchar(255) | NO |  | NULL |  |
| file_path | varchar(255) | NO |  | NULL |  |
| uploaded_at | timestamp | YES |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |

## Table: compute_details

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int | NO | PRI | NULL | auto_increment |
| company_id | int | NO |  | NULL |  |
| quotation_id | int | YES |  | NULL |  |
| node_name | varchar(255) | YES |  | NULL |  |
| private_ip | varchar(255) | YES |  | NULL |  |
| public_ip | varchar(255) | YES |  | NULL |  |
| server_name | varchar(255) | YES |  | NULL |  |
| created_at | timestamp | YES |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |

## Table: crmleads

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int | NO | PRI | NULL | auto_increment |
| added_by | int | NO |  | NULL |  |
| company_id | int | YES |  | NULL |  |
| lead_status | varchar(100) | NO |  | NULL |  |
| lead_source | varchar(100) | NO |  | NULL |  |
| follow_up_date | date | NO |  | NULL |  |
| expected_closer | date | NO |  | NULL |  |
| website | varchar(255) | YES |  | NULL |  |
| description | text | NO |  | NULL |  |
| created_at | datetime | YES |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| updated_at | datetime | YES |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |

## Table: permissions

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int | NO | PRI | NULL | auto_increment |
| role | varchar(50) | NO |  | NULL |  |
| menu_item | varchar(100) | NO |  | NULL |  |

## Table: product_categories

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int unsigned | NO | PRI | NULL | auto_increment |
| name | varchar(255) | NO |  | NULL |  |
| description | text | YES |  | NULL |  |
| status | enum('active','inactive') | NO |  | active |  |
| created_at | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| updated_at | datetime | YES |  | NULL |  |

## Table: products

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int unsigned | NO | PRI | NULL | auto_increment |
| name | varchar(255) | NO |  | NULL |  |
| description | text | YES |  | NULL |  |
| category_id | int unsigned | YES |  | NULL |  |
| price | decimal(10,2) | NO |  | 0.00 |  |
| status | enum('active','inactive') | NO |  | active |  |
| added_date | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| updated_at | datetime | YES |  | NULL |  |

## Table: quotations

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int unsigned | NO | PRI | NULL | auto_increment |
| sof_id | varchar(200) | YES | UNI | NULL |  |
| antivirus_backup | varchar(10) | YES |  | NULL |  |
| description | text | NO |  | NULL |  |
| location | varchar(100) | NO |  | NULL |  |
| server_type | varchar(100) | NO |  | NULL |  |
| otc | decimal(10,2) | YES |  | NULL |  |
| sub_total | decimal(10,2) | YES |  | NULL |  |
| lead_id | int | NO |  | NULL |  |
| company_id | int | NO |  | NULL |  |
| client_confirmation | varchar(500) | YES |  | NULL |  |
| contract_terms_yrs | int | YES |  | 0 |  |
| contract_term_month | int | YES |  | 0 |  |
| billing_cycle | tinyint(1) | YES |  | 1 |  |
| billing_period | date | YES |  | NULL |  |
| billing_start | enum('Yes','No') | YES |  | No |  |
| delivery_period_week | int | YES |  | 0 |  |
| delivery_period | int | YES |  | 0 |  |
| currency | varchar(10) | YES |  | INR |  |
| applicabletax | enum('0','1') | YES |  | 0 |  |
| applicablevat | enum('0','1') | YES |  | 1 |  |
| added_by | int | NO |  | NULL |  |
| updated | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
| added_date | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| quotation_status | varchar(20) | NO |  | open |  |
| supportRemarks | varchar(500) | YES |  | NULL |  |
| clientRemarks | varchar(500) | YES |  | NULL |  |
| accountRemarks | varchar(500) | YES |  | NULL |  |
| status | int | NO |  | 1 |  |
| requested_for_deletion | int | NO |  | 0 |  |
| deletion_remarks | text | YES |  | NULL |  |
| demo_start_date | date | YES |  | NULL |  |
| demo_end_date | date | YES |  | NULL |  |

## Table: quotationsold

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int unsigned | NO | PRI | NULL | auto_increment |
| antivirus_backup | varchar(10) | YES |  | NULL |  |
| description | text | NO |  | NULL |  |
| location | varchar(100) | NO |  | NULL |  |
| server_type | varchar(100) | NO |  | NULL |  |
| otc | decimal(10,2) | YES |  | NULL |  |
| sub_total | decimal(10,2) | YES |  | NULL |  |
| lead_id | int | NO |  | NULL |  |
| company_id | int | NO |  | NULL |  |
| added_by | int | NO |  | NULL |  |
| updated | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
| added_date | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| quotation_status | varchar(20) | NO |  | open |  |
| status | int | NO |  | 1 |  |

## Table: quote_details

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int unsigned | NO | PRI | NULL | auto_increment |
| quotation_id | int | YES |  | NULL |  |
| product_id | int unsigned | NO | MUL | NULL |  |
| attribute_type | int unsigned | NO | MUL | NULL |  |
| attribute_id | int unsigned | NO | MUL | NULL |  |
| reg_price | decimal(10,2) | NO |  | 0.00 |  |
| unit | int unsigned | NO |  | 1 |  |
| sale_price | decimal(10,2) | NO |  | 0.00 |  |
| total_price | decimal(12,2) | NO |  | 0.00 |  |
| added_date | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| custom_details | text | YES |  | NULL |  |

## Table: users

| Field | Type | Null | Key | Default | Extra |
| --- | --- | --- | --- | --- | --- |
| id | int | NO | PRI | NULL | auto_increment |
| name | varchar(200) | YES |  | NULL |  |
| email | varchar(200) | YES |  | NULL |  |
| gender | varchar(20) | YES |  | NULL |  |
| username | varchar(100) | NO |  | NULL |  |
| password | varchar(255) | NO |  | NULL |  |
| role | enum('admin','user') | NO |  | user |  |
| updated_at | datetime | NO |  | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |

