     @foreach ($coupons as $coupon)
            <tr class="row1" data-id="{{ $coupon->id }}">
                <td><input type="checkbox" name="selected_coupons[]" value="{{ $coupon->id }}"></td>
                <th scope="row">{{ $loop->iteration }}</th>
                <td class="pl-3"><i class="fa fa-sort"></i></td>
                <td>{{ $coupon->name ?:'null' }}</td>
                                <td>
                                    @if ($coupon->stores)
                                {{ $coupon->stores->name ?:'null' }}
                                    @else
                                {{ $coupon->store ?:'null' }}
                                    @endif
                                </td>
                <td>
                    @if ($coupon->code)
                        <span class="custom-badge bg-primary text-white">Code</span>
                    @else
                        <span class="custom-badge bg-success text-white">Deal</span>

                    @endif
                </td>
                             <!--<td>-->
                <!--    @if ($coupon->authentication == "never_expire")-->
                <!--        <i class="fa fa-fw fa-check-circle" style="color: blue;"></i>-->
                <!--    @else-->
                <!--        <i class="fa fa-fw fa-times-circle"style="color:red;"></i>-->
                <!--    @endif-->
                <!--</td>-->
                <td>
                   @if ($coupon->status == "disable")
                        <i class="fa fa-fw fa-times-circle" style="color: blue;"></i>
                    @else
                        <i class="fa fa-fw fa-check-circle" style="color: green;"></i>
                    @endif
                </td>
                <td>{{ $coupon->user->name ?? null }}</td>
                       <td>
    <p class="badge bg-info text-dark" data-bs-toggle="tooltip" title="{{ $coupon->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
        {{ $coupon->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
    </p>
</td>
<td>
    <p class="badge bg-warning text-dark" data-bs-toggle="tooltip" title="{{ $coupon->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
        {{ $coupon->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
    </p>
</td>

                <td>
                    <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <a href="{{ route('admin.coupon.delete', $coupon->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach
