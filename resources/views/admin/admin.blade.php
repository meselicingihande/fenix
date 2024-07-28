@foreach ($subscriptions as $subscription)
    <p>{{ $subscription->device->device_name }} - {{ $subscription->product_id }}</p>
@endforeach