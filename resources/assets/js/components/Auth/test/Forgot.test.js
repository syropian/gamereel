import { mount, shallow } from "vue-test-utils";
import { createRenderer } from "vue-server-renderer";
import Forgot from "../src/Forgot";

describe("Forgot Component", () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(Forgot);
  });

  it("sets the appropriate user data when the fields are typed in", () => {
    const vm = wrapper.vm;
    type("jane@doe.com", "input[name=email]");
    expect(vm.email).toBe("jane@doe.com");
  });

  it("matches the correct snapshot", () => {
    const renderer = createRenderer();
    const shallowWrapper = shallow(Forgot);
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
