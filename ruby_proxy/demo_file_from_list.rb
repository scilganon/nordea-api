require 'rubygems'
require 'bundler/setup'


#require 'nordea-filetransfer'
require 'active_support'
require "nordea/file_transfer"

key_path = '/home/Projects/ruby-test/cert/WSNDEA1234.pem'


Nordea::FileTransfer.configure do |config|
  config.language = "EN"
  config.environment = "PRODUCTION"
  config.user_agent = "Ruby"
  config.software_id = "Ruby"
  config.cert_file = key_path
  config.private_key_file = key_path
  config.sender_id = 11111111
end

client = Nordea::FileTransfer::Client.new

# SW940 - (swift) not found
# NDCAMT53L - (xml) authorization failed
# FINRACSTL - (ascii) authorization failed

file_type = 'TITO'

response = client.download_file_list do |header, request|
  header.receiver_id  = 123456789
  request.customer_id = 162355330
  request.target_id = '11111111A1'
  request.file_type = file_type
  request.status = 'ALL'
end

account_statement_ref = response.application_response.file_descriptors.first


response = client.download_file do |header, request|
  header.receiver_id      = 123456789
  request.customer_id     = 162355330
  request.file_references = [account_statement_ref.file_reference]
  request.target_id       = "11111111A1"
  request.software_id     = "Ruby"
  request.file_type       = "TITO"
  request.status = 'ALL'
end

#todo: understand format of ASCII doc
puts response.application_response.content