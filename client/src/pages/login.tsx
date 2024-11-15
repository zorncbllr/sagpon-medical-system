import { LoginForm } from "../components/login-form";

function Login() {
  return (
    <main className="w-full h-screen flex bg-primary-foreground">
      <section className="w-full p-10 grid place-items-center">
        <div className="w-full bg-green-500 h-full rounded-lg"></div>
      </section>
      <section className=" w-[70%] grid  place-items-center">
        <LoginForm />
      </section>
    </main>
  );
}

export default Login;
