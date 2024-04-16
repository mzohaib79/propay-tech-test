
<h3> Hi, {{ $user->name }}</h3>

<p class="" style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left">
    Welcome to Our System!

    You're now part of our community. If you need any assistance, please reach out to us at techtest@propay.com.
</p>

<div>
    <span>Name:</span><span>{{ $user->name }}</span>
</div>
<div>
    <span>Surname:</span><span>{{ $user->surname }}</span>
</div>
<div>
    <span>Email:</span><span>{{ $user->email }}</span>
</div>

<div>
    <span>South African Id Number:</span><span>{{ $user->sid_number }}</span>
</div>
<div>
    <span>Mobile Number:</span><span>{{ $user->mobile_number }}</span>
</div>
<div>
    <span>Date Of Birth:</span><span>{{ $user->date_of_birth }}</span>
</div>
<div>
    <span>Language:</span><span>{{ $user->language }}</span>
</div>
