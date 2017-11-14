import { flattenErrors } from "../errors";

describe("Errors helpers", () => {
  it("can flatten an array of Laravel validation errors down to a simple list of validation messages", () => {
    const validationErrors = {
      email: ["Invalid email"],
      gamertag: ["Gamertag required"],
      password: ["Password confirmation did not match"]
    };

    expect(flattenErrors(validationErrors)).toEqual([
      "Invalid email",
      "Gamertag required",
      "Password confirmation did not match"
    ]);
  });
});
