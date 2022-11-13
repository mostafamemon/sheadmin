<tbody>
    @php $pending_sales = getPendingSales(); @endphp
    @foreach($pending_sales as $key => $sales)
        <tr>
            <td class=" text-center th-4p th-40px" style="padding:12px !important;">{{$loop->iteration}}</td>
            <td class="th-36p th-250px">{{$sales['product_name']}}</td>
            <td class=" text-right th-15p th-130px">
                @if($edit_key === $key)
                    <input type="text" class="form-control-shrink text-center" wire:model.lazy="edit_quantity"/>
                    @error('edit_quantity')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                @else
                    {{$sales['quantity']}} {{$sales['unit']}}
                @endif
            </td>
            <td class=" text-right th-15p th-300px">
                @if($edit_key === $key)
                    <input type="text" class="form-control-shrink text-center" wire:model.lazy="edit_unit_price"/>
                    @error('edit_unit_price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                @else
                    @if($settings->allow_decimal_number == true)
                        {{ number_format($sales['unit_price'], 2, '.', '') }}
                    @else
                        {{ $sales['unit_price'] }}
                    @endif
                @endif
            </td>
            <td class="text-right th-15p th-100px">
                @if($settings->allow_decimal_number == true)
                    {{ number_format($sales['total'], 2, '.', '') }}
                @else
                    {{ $sales['total'] }}
                @endif
            </td>
            <td class="text-center th-15p th-100px">
                @if($edit_key === $key)
                    <button class="btn btn-success btn-sm" wire:click="editCache({{$key}})"><i class="fa fa-check-circle"></i></button>
                @else
                    <button class="btn btn-warning btn-sm" wire:click="setEditKey({{$key}})"><i class="fa fa-edit"></i></button>
                @endif

                @if($delete_key === $key)
                    <button class="btn btn-danger btn-xs" wire:click="deleteFromCache()">Confirm?</button>
                @else
                    <button class="btn btn-danger btn-sm" wire:click="setDeleteKey({{$key}})"><i class="fa fa-trash-alt"></i></button>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>