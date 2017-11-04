import { mount, shallow } from "vue-test-utils";
import { createRenderer } from "vue-server-renderer";
import Register from "../src/Register";

describe("Register Component", () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(Register);
  });

  it("sets the appropriate user data when the fields are typed in", () => {
    const vm = wrapper.vm;
    type("xX420SnipeItBlazexXx", "input[name=gamertag]");
    type("jane@doe.com", "input[name=email]");
    type("gamereel", "input[name=password]");
    type("gamereel", "input[name=password_confirmation]");
    expect(vm.user).toEqual({
      gamertag: "xX420SnipeItBlazexXx",
      email: "jane@doe.com",
      password: "gamereel",
      password_confirmation: "gamereel"
    });
  });

  it("matches the correct snapshot", () => {
    const renderer = createRenderer();
    const shallowWrapper = shallow(Register);
    renderer.renderToString(shallowWrapper.vm, (err, str) => {
      if (err) throw new Error(err);
      expect(str).toMatchSnapshot();
    });
  });

  const type = (text, selector) => {
    const node = wrapper.find(selector);
    node.element.value = text;
    node.trigger("input");
  };
});
