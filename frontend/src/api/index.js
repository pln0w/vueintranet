import axios from 'axios'
import config from '../config'

export default {
  request (method, uri, data = null) {
    if (!method) {
      console.error('API function call requires method argument')
      return
    }

    if (!uri) {
      console.error('API function call requires uri argument')
      return
    }

    var url = config.serverURI + uri

    // eslint-disable-next-line quotes
    return axios({method, url, data, headers: {"Access-Control-Allow-Origin": "*"}})
  }
}
