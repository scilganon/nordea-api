require 'dotenv'
Dotenv.load

require 'rubygems'
require 'bundler/setup'

require 'oj'
require 'active_support'
require "nordea/file_transfer"
require 'jimson'



# puts response.application_response
# => Nordea::FileTransfer::ApplicationResponse


class OJAdapter
  def encode(object, options = {})
      ::Oj.dump(object, options)
  end

  def decode(string, options = {})
    ::Oj.load(string, options)
  end
end

# MultiJson.engine = OJAdapter.new


class Server
  extend Jimson::Handler

  def get_user_info(request)
      run 'get_user_info', request['config'], request['header'], request['request']
  end

  def download_file(request)
    run 'download_file', request['config'], request['header'], request['request']
  end

  def download_file_list(request)
    run 'download_file_list', request['config'], request['header'], request['request']
  end

  def upload_file(request)
    run 'upload_file', request['config'], request['header'], request['request']
  end

  def run(method, iconfig, iheader, irequest)
    key_path = ENV['KEY_PATH']

    Nordea::FileTransfer.configure do |config|
      iconfig.each { |key, value|
        config.send("#{key.snakecase}=", value)
      }

      config.cert_file = key_path
      config.private_key_file = key_path
    end

    client = Nordea::FileTransfer::Client.new

    begin
      response = client.public_send(method) do |header, request|
        iheader.each { |key, value|
          header.send("#{key.snakecase}=", value)
        }

        irequest.each { |key, value|
          request.send("#{key.snakecase}=", value)
        }

        puts 'ok'
      end

      puts response.application_response

      Oj.dump(response)
    rescue Nordea::FileTransfer::Error => e
      e
    end
  end
end



server = Jimson::Server.new(Server.new, {
    :host => ENV['HOST'],
    :port => ENV['PORT']
})
server.start # serve with webrick on http://0.0.0.0:8999/