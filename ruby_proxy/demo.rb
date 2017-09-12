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

response = client.get_user_info do |header, request|
  header.receiver_id  = 123456789
  request.customer_id = 162355330
end

# response.response_header
# => Nordea::FileTransfer::ResponseHeader

puts response.application_response
# => Nordea::FileTransfer::ApplicationResponse