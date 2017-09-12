
require 'rubygems'
require 'bundler/setup'

require 'jimson'
require 'active_support'
require "nordea/file_transfer"
require "json"


# puts response.application_response
# => Nordea::FileTransfer::ApplicationResponse

class Server
  extend Jimson::Handler

  def get_user_info(request)
    run 'get_user_info', request['iConfig'], request['iHeader'], request['iRequest']
  end

  def download_file(request)
    run 'download_file', request['iConfig'], request['iHeader'], request['iRequest']
  end

  def download_file_list(request)
    run 'download_file_list', request['iConfig'], request['iHeader'], request['iRequest']
  end

  def upload_file(request)
    run 'upload_file', request['iConfig'], request['iHeader'], request['iRequest']
  end

  def run(method, iconfig, iheader, irequest)
    key_path = '/home/Projects/ruby-test/cert/WSNDEA1234.pem'

    Nordea::FileTransfer.configure do |config|
      iconfig.each { |key, value|
        config.send("#{key}=", value)
      }

      config.cert_file = key_path
      config.private_key_file = key_path
    end

    client = Nordea::FileTransfer::Client.new

    response = client.public_send(method) do |header, request|
      iheader.each { |key, value|
        header.send("#{key}=", value)
      }

      irequest.each { |key, value|
        request.send("#{key}=", value)
      }
    end

    puts response

    response
  end
end

server = Jimson::Server.new(Server.new)
server.start # serve with webrick on http://0.0.0.0:8999/