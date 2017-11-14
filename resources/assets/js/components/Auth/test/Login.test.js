import { mount, shallow } from 'vue-test-utils'
import { createRenderer } from 'vue-server-renderer'
import Login from '../Login'

describe('Login Component', () => {
  let wrapper

  beforeEach(() => {
    wrapper = mount(Login)
  })

  it('sets the appropriate user data when the fields are typed in', () => {
    const vm = wrapper.vm
    type('jane@doe.com', 'input[name=email]')
    type('gamereel', 'input[name=password]')
    expect(vm.user.email).toBe('jane@doe.com')
    expect(vm.user.password).toBe('gamereel')
  })

  it('matches the correct snapshot', () => {
    const renderer = createRenderer()
    const shallowWrapper = shallow(Login)
    renderer.renderToString(shallowWrapper.vm, (err, str) => {
      if (err) throw new Error(err)
      expect(str).toMatchSnapshot()
    })
  })

  const type = (text, selector) => {
    const node = wrapper.find(selector)
    node.element.value = text
    node.trigger('input')
  }
})
