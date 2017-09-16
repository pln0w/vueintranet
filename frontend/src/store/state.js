export default {
  callingAPI: false,
  searching: '',
  serverURI: 'http://vueintranet.dev:8000',
  user: null,
  token: null,
  userInfo: {
    messages: [
      {
        title: 'First title',
        message: 'My test message'
      },
      {
        title: 'Another title',
        message: 'Second msg'
      }
    ],
    notifications: [],
    tasks: [
      {
        title: 'Backend for this website',
        status: 'In progress',
        value: 35
      },
      {
        title: 'Frontend website',
        status: 'In progress',
        value: 12
      }
    ]
  }
}
