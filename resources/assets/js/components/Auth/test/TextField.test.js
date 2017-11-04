import { shallow } from "vue-test-utils";
import { createRenderer } from "vue-server-renderer";
import TextField from "../src/TextField";

describe("TextField Component", () => {
  let wrapper;

  beforeEach(() => {
    wrapper = shallow(TextField, {
      propsData: {
        name: "email",
        type: "email",
        placeholder: "jane@doe.com",
        value: "john@doe.com"
      }
    });
  });

  it("passes the props to the input", () => {
    const el = wrapper.find("input").element;
    expect(el.getAttribute("name")).toBe("email");
    expect(el.getAttribute("type")).toBe("email");
    expect(el.getAttribute("placeholder")).toBe("jane@doe.com");
    expect(el.getAttribute("value")).toBe(null);
  });

  it("emits an input event on input", () => {
    const input = wrapper.find("input");
    input.element.value = "Hello";
    input.trigger("input");

    expect(wrapper.emitted().input).toBeTruthy();
    expect(wrapper.emitted().input[0]).toEqual(["Hello"]);
  });

  it("matches the correct snapshot", () => {
    const renderer = createRenderer();
    renderer.renderToString(wrapper.vm, (err, str) => {
      if (err) throw new Error(err);
      expect(str).toMatchSnapshot();
    });
  });
});
